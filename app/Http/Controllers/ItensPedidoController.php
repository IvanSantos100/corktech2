<?php

namespace CorkTech\Http\Controllers;

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

    public function index($id)
    {

        //$itenspedido = $this->pedidosRepository->itensPedido($id);

        $itenspedido = $this->itensPedidosRepository->scopeQuery(function($query) use($id){
            return $query->where('pedido_id',$id);
        })->paginate(10);


        if ($itenspedido->isEmpty()) {

            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $id]);
        }

        return view('admin.itenspedido.index', compact('itenspedido'));


    }

    public function listarProdutos(Request $request, $id)
    {

        $search = $request->get('search');

        $this->produtosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $produtos = $this->produtosRepository->paginate(10);
        $pedidoId = $id;

        return view('admin.itenspedido.produtos', compact('produtos', 'search', 'pedidoId'));
    }

    public function addProdudo(Request $request, $id)
    {
        $userId = \Auth::user()->centrodistribuicao_id;
        $produto = $this->produtosRepository->find($request->produto_id);
        $pedido = $this->pedidosRepository->find($id);
        if($pedido->tipo === 'Entrada'){
            $pedido->produtos()->attach($request->produto_id,['quantidade'=>$request->quantidade,'preco'=>123, 'prazoentrega'=>'2017-01-01']);

            \Session::flash('message', 'Produto incluido no pedido.');
            return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $id]);
        }
        if($pedido->tipo === 'Movimentação'){

        }
        if($pedido->tipo === 'Saída'){

        }
        //dd($pedido, $produto->estampas, $produto->classes, $produto->tipoprodutos, $produto->pedidos);
        //$pedido->produtos()->attach(1,['quantidade'=>100,'preco'=>123, 'prazoentrega'=>'2017-01-01']);

    }

    public function editProdudo($pedidoId, $produtoId)
    {
        $pedido = $this->pedidosRepository->find($pedidoId);

        dd($pedido);

        $produto = $pedido->produtos->find(1);

        return view('admin.itenspedido.edit', compact('produto'));
    }


}
