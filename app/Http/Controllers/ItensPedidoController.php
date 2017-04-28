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

        /*$itenspedido = $this->itensPedidosRepository->scopeQuery(function($query) use($id){

            return $query->leftJoin('produtos', 'itens_pedidos.produto_id', '=', 'produtos.id')
                ->where('pedido_id',$id)
                ->orderBy('produtos.descricao');
        })->paginate(10);*/

        $itenspedido = $this->pedidosRepository->find($id)->produtos()->orderBy('descricao')->paginate(10);

        if ($itenspedido->isEmpty()) {

            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $id, 'ver' => true]);
        }

        return view('admin.itenspedido.index', compact('itenspedido', 'search'));
    }

    public function listarProdutos(Request $request, $pedidoId)
    {
        $search = $request->get('search');
        $ver = $request->get('ver');

        $this->produtosRepository->pushCriteria(new FindByProdutosCriteria($pedidoId));
        //$this->centroDistribuicoesRepository->pushCriteria(FindByProdutoEstoque::class);

        $produtos = $this->produtosRepository->orderBy('descricao')->paginate(10);

        //dd($produtos);

        return view('admin.itenspedido.produtos', compact('produtos', 'search', 'pedidoId', 'ver'));
    }

    public function addProdudo(Request $request, $pedidoId)
    {
        $produto = $this->produtosRepository->find($request->produto_id);

        $pedido = $this->pedidosRepository->find($pedidoId);

        //if ($pedido->tipo === 'Entrada')
        {

            $pedido->produtos()->attach($request->produto_id, ['quantidade' => $request->quantidade, 'preco' => $produto->preco, 'prazoentrega' => '2017-01-01']);

            $this->pedidosRepository->updateValorPedido($pedidoId);

            \Session::flash('message', 'Produto incluido no pedido.');
            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $pedidoId]);
        }
        /*
        if ($pedido->tipo === 'Movimentação') {

        }
        if ($pedido->tipo === 'Saída') {

        }
        */
    }

    public function editProdudo($pedidoId, $produtoId)
    {
        /*$produtos = $this->pedidosRepository->scopeQuery(function ($query) use ($pedidoId, $produtoId) {
            return $query->find($pedidoId)->produtos()->where('produtos.id', $produtoId)->get();
        })->all();
        */

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
