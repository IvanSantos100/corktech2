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
        PedidosRepository $pedidosRepository,
        ItemPedidoRepository $repository,
        ProdutosRepository $produtosRepository,
        TipoProdutosRepository $tipoProdutosRepository
    )
    {
        $this->pedidosRepository = $pedidosRepository;
        $this->repository = $repository;
        $this->produtosRepository = $produtosRepository;
        $this->tipoProdutosRepository = $tipoProdutosRepository;
    }

    public function index(Request $request, $id)
    {
        dd($this->repository->all());
        /*$search = $request->get('search');

        $this->produtosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $produtos = $this->produtosRepository->scopeQuery(function ($query){
            return $query->orderBy('descricao','asc');
        })->paginate(10);

        return view('admin.itenspedido.produtos', compact('produtos', 'search'));*/
    }

    public function listarProdutos($pedidoId)   ///http://localhost:8000/admin/itempedido/10/produtos
    {
        //$this->pedidosRepository->find($pedidoId);

        $tipo = $this->tipoProdutosRepository->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->all();

        $this->produtosRepository->pushCriteria(new FindByProdutosCriteria($pedidoId));

        $produtos = $this->produtosRepository->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->paginate(10);

        return view('admin.itenspedido.produtos', compact('produtos', 'pedidoId', 'tipo'));
    }

    public function addProdudo(Request $request, $pedidoId)
    {
        $this->repository->create([
            'pedido_id' => $pedidoId,
            'produto_id' => 1,
            'quantidade' => 1,
            'preco' => 1,
            'desconto' => 1,
            'prazoentrega' => '2017-07-07'
        ]);
        ///dd($request);

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

    public function deleteProduto(Request $request, $pedidoId, $produtoId, $lote)
    {

    }
}
