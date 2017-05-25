<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByPedidoPendenteCriteria;
use CorkTech\Criteria\FindByProdutoEstoque;
use CorkTech\Criteria\FindByProdutosCriteria;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\ItensPedidosRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ProdutosRepository;
use Illuminate\Http\Request;

class ItensPedidoController extends Controller
{


    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var ItensPedidosRepository
     */
    private $itensPedidosRepository;
    /**
     * @var CentroDistribuicoesRepository
     */
    private $centroDistribuicoesRepository;

    public function __construct(
        PedidosRepository $pedidosRepository,
        ProdutosRepository $produtosRepository,
        ItensPedidosRepository $itensPedidosRepository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository
    )
    {
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
        $this->itensPedidosRepository = $itensPedidosRepository;

        $this->pedidosRepository->pushCriteria(new FindByPedidoPendenteCriteria());
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
    }

    public function index(Request $request, $id)
    {
        $search = $request->get('search');

        $this->produtosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $pedido = $this->pedidosRepository->find($id);

        $itenspedido = $pedido->produtos()->orderBy('descricao')->paginate(10);

        if ($itenspedido->isEmpty()) {

            return redirect()->route('admin.itenspedido.produtos', ['pedido' => $pedido->id, 'ver' => true]);
        }

        return view('admin.itenspedido.index', compact('itenspedido', 'search', 'pedido'));
    }

    public function listarProdutos(Request $request, $pedidoId)
    {
        $search = $request->get('search');
        $ver = $request->get('ver');

        $pedido = $this->pedidosRepository->find($pedidoId);

        $tipo = $pedido->tipo === 'Entrada';
        $origemid = $pedido->origem_id;

        //$this->produtosRepository->pushCriteria(FindByProdutoEstoque::class);  //centrodistribuicao  CentroDistribuicao


        $this->produtosRepository->pushCriteria(new FindByProdutosCriteria($pedidoId, $tipo));
        if ($tipo) {
            $produtos = $this->produtosRepository->orderBy('descricao')->paginate(10);
        }else {
            $produtos = $this->produtosRepository->scopeQuery(function ($query) use ($origemid) {
                return $query->join('estoques', 'produtos.id', '=', 'estoques.produto_id')
                    ->where('estoques.centrodistribuicao_id', $origemid)
                    ->orderBy('descricao');
            })->paginate(10);
        }

        return view('admin.itenspedido.produtos', compact('produtos', 'search', 'pedido', 'ver', 'tipo'));
    }

    public function addProdudo(Request $request, $pedidoId)
    {

        $pedido = $this->pedidosRepository->find($pedidoId);

        if($request->quantidade > $request->max && $pedido->tipo !== 'Entrada') {
            \Session::flash('error', 'Produto com quantidade superior ao estoque.');
            return redirect()->back();
        }

        $produto = $this->produtosRepository->find($request->produto_id);

        if ($pedido->tipo === 'Entrada') {
            $pedido->produtos()->attach($request->produto_id, ['quantidade' => $request->quantidade, 'preco' => $produto->preco,'prazoentrega' => '2017-01-01']);

            $this->pedidosRepository->updateValorPedido($pedidoId);

            \Session::flash('message', 'Produto incluido no pedido.');
            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $pedidoId]);
        }

        if ($pedido->tipo === 'Movimentação') {

            //dd($produto, $pedido);
            $pedido->produtos()->attach($request->produto_id, ['quantidade' => $request->quantidade, 'preco' => $produto->preco, 'lote' => $request->lote,'prazoentrega' => '2017-01-01']);

            $this->pedidosRepository->updateValorPedido($pedidoId);

            \Session::flash('message', 'Produto incluido no pedido.');
            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $pedidoId]);

        }
        if ($pedido->tipo === 'Saída') {

            //dd($produto, $pedido);
            $pedido->produtos()->attach($request->produto_id, ['quantidade' => $request->quantidade, 'preco' => $produto->preco, 'lote' => $request->lote,'prazoentrega' => '2017-01-01']);

            $this->pedidosRepository->updateValorPedido($pedidoId);

            \Session::flash('message', 'Produto incluido no pedido.');
            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $pedidoId]);

        }

    }

    public function editProdudo($pedidoId, $produtoId)
    {

        $produtos = $this->pedidosRepository->find($pedidoId)->produtos()->where('produtos.id', $produtoId)->get();

        return view('admin.itenspedido.edit', compact('produtos', 'pedidoId'));
    }

    public function updateProdudo(Request $request, $pedidoId, $produtoId)
    {

        $this->itensPedidosRepository->updateOrCreate(['pedido_id' => $pedidoId, 'produto_id' => $produtoId], ['quantidade' => $request->quantidade]);

        $this->pedidosRepository->updateValorPedido($pedidoId);

        \Session::flash('message', 'Produto atualizado.');
        return redirect()->route('admin.itenspedido.index', ['pedidoId' => $pedidoId]);
    }

    public function deleteProduto($pedidoId, $produtoId)
    {
        $pedido = $this->pedidosRepository->find($pedidoId)->produtos()->detach($produtoId);

        $this->pedidosRepository->updateValorPedido($pedidoId);

        \Session::flash('message', 'Produto excluído.');
        return redirect()->route('admin.itenspedido.index', ['pedidoId' => $pedidoId]);
    }


}

//https://www.google.com.br/search?q=impedir+campos+iguais+valides+laravel&oq=impedir+campos+iguais+valides+laravel&aqs=chrome..69i57.33127j0j7&sourceid=chrome&ie=UTF-8
