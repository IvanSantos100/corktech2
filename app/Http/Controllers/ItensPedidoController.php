<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByProdutosCriteria;
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

    public function __construct(
        PedidosRepository $pedidosRepository,
        ProdutosRepository $produtosRepository,
        ItensPedidosRepository $itensPedidosRepository
    )
    {
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
        $this->itensPedidosRepository = $itensPedidosRepository;
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

        //dd($itenspedido);

        if ($itenspedido->isEmpty()) {

            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $id]);
        }

        return view('admin.itenspedido.index', compact('itenspedido', 'search'));


    }

    public function listarProdutos(Request $request, $pedidoId)
    {

        $search = $request->get('search');

        $this->produtosRepository->pushCriteria(new FindByProdutosCriteria($pedidoId));

        $produtos = $this->produtosRepository->scopeQuery(function ($query) {
            return $query->orderBy('descricao');
        })->paginate(10);

        return view('admin.itenspedido.produtos', compact('produtos', 'search', 'pedidoId'));
    }

    public function addProdudo(Request $request, $id)
    {
        $userId = \Auth::user()->centrodistribuicao_id;
        $produto = $this->produtosRepository->find($request->produto_id);
        //dd($produto);
        $pedido = $this->pedidosRepository->find($id);
        //dd($pedido);
        if ($pedido->tipo === 'Entrada') {
            $pedido->produtos()->attach($request->produto_id, ['quantidade' => $request->quantidade, 'preco' => $produto->preco, 'prazoentrega' => '2017-01-01']);

            \Session::flash('message', 'Produto incluido no pedido.');
            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $id]);
        }
        if ($pedido->tipo === 'Movimentação') {

        }
        if ($pedido->tipo === 'Saída') {

        }
    }

    public function editProdudo($pedidoId, $produtoId)
    {
        /*$produtos = $this->pedidosRepository->scopeQuery(function ($query) use ($pedidoId, $produtoId) {
            return $query->find($pedidoId)->produtos()->where('produtos.id', $produtoId)->get();
        })->all();
        */

        $produtos = $this->pedidosRepository->find($pedidoId)->produtos()->where('produtos.id', $produtoId)->get();

        //dd($produtos[0]->pivot->quantidade);

        return view('admin.itenspedido.edit', compact('produtos', 'pedidoId'));
    }

    public function updateProdudo(Request $request, $pedidoId, $produtoId)
    {
       //$this->itensPedidosRepository->wehre
        //$i = CorkTech\Models\ItemPedido::updateOrCreate(['quantidade'=>100],['pedido_id'=>6, 'produto_id'=>29])

    }

    public function deleteProduto($pedidoId, $produtoId)
    {
        $pedido = $this->pedidosRepository->find($pedidoId)->produtos()->detach($produtoId);

        \Session::flash('message', 'Produto excluído.');
        return redirect()->route('admin.itenspedido.index', ['pedidoId' => $pedidoId]);
    }


}
