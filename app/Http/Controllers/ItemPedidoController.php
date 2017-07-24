<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByProdutosCriteria;
use CorkTech\Repositories\ItemPedidoRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ProdutosRepository;
use CorkTech\Repositories\TipoProdutosRepository;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{


    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var ItemPedidoRepository
     */
    private $repository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var TipoProdutosRepository
     */
    private $tipoProdutosRepository;

    public function __construct(
        ItemPedidoRepository $repository,
        PedidosRepository $pedidosRepository,
        ProdutosRepository $produtosRepository,
        TipoProdutosRepository $tipoProdutosRepository
    )
    {
        $this->repository = $repository;
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
        $this->tipoProdutosRepository = $tipoProdutosRepository;
    }

    public function index(Request $request, $pedidoId)
    {
        $this->pedidosRepository->find($pedidoId);

        $itens_pedidos = $this->repository->scopeQuery(function ($query) use($pedidoId){
            return $query->Where('pedido_id',$pedidoId);
        })->paginate(10);

        if ($itens_pedidos->isEmpty()) {
            return redirect()->route('admin.itempedido.produtos', ['pedido' => $pedidoId]);
        }

        return view('admin.itempedido.index', compact('itens_pedidos','pedidoId'));
    }

    public function listarProdutos(Request $request, $pedidoId)
    {
        $search = explode(':',$request->get('search'));

        $pedido = $this->pedidosRepository->find($pedidoId);

        $tipo = $this->tipoProdutosRepository->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->all();

        $this->produtosRepository->pushCriteria(new FindByProdutosCriteria($pedidoId, $this->pedidosRepository));

        $produtos = $this->produtosRepository->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->paginate(10);

        //dd($produtos[0]->estoques);

        return view('admin.itempedido.produtos', compact('produtos', 'pedido', 'search', 'tipo'));
    }

    public function addProdudo(Request $request, $pedidoId)
    {
        //dd($request->all());

        foreach ($request->quantidade as $key => $qnt) {

            $this->repository->create([
                'pedido_id' => $pedidoId,
                'produto_id' => $request->produto_id,
                'lote' => $request->lote[$key],
                'quantidade' => $qnt,
            ]);
        }

        $url = $request->get('redirect_to', route('admin.itempedido.produtos',['pedidoId' => $pedidoId]));
        $request->session()->flash('message', "Produto incluido com sucesso." );

        return redirect()->to($url);
    }

    public function editProdudo($pedidoId, $produtoId)
    {

    }

    public function updateProdudo(Request $request, $pedidoId, $produtoId)
    {

    }

    public function deleteProduto($pedidoId, $itempedido)
    {
        $pedido = $this->repository->delete($itempedido);

        if($pedido == 1) {
            \Session::flash('message', 'Produto excluído.');
        }else{
            \Session::flash('error', 'Produto não excluído.');
        }

        return redirect()->route('admin.itempedido.index', ['pedidoId' => $pedidoId]);
    }
}
