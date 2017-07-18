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
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var ItensPedidosRepository
     */
    private $repository;

    public function __construct(ItensPedidosRepository $repository, ProdutosRepository $produtosRepository)
    {
        $this->produtosRepository = $produtosRepository;
        $this->repository = $repository;
    }

    public function index(Request $request, $id)
    {
        $search = $request->get('search');

        $this->produtosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $produtos = $this->produtosRepository->scopeQuery(function ($query){
            return $query->orderBy('descricao','asc');
        })->paginate(10);

        return view('admin.itenspedido.produtos', compact('produtos', 'search'));
    }

    public function listarProdutos(Request $request, $pedidoId)   ///http://localhost:8000/admin/itenspedido/10/produtos
    {
        $search = $request->get('search');

        $this->produtosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $produtos = $this->produtosRepository->scopeQuery(function ($query){
            return $query->orderBy('descricao','asc');
        })->paginate(10);

        //dd($produtos);
        return view('admin.itenspedido.produtos', compact('produtos', 'search'));
    }

    public function addProdudo(Request $request, $pedidoId)
    {


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
