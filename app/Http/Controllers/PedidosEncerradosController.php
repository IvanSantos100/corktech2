<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByPedidoEncerradoCriteria;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ClientesRepository;
use CorkTech\Repositories\ProdutosRepository;
use CorkTech\Repositories\ItemPedidoRepository;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PedidosEncerradosController extends Controller
{
    /**
     * @var PedidosRepository
     */
    protected $repository;
    /**
     * @var CentroDistribuicoesRepository
     */
    private $origensRepository;
    /**
     * @var CentrodistribuicoesRepository
     */
    private $destinosRepository;
    /**
     * @var ClientesRepository
     */
    private $clientesRepository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;

    private $itempedidosRepository;


    public function __construct(
        PedidosRepository $repository,
        CentroDistribuicoesRepository $origensRepository,
        CentroDistribuicoesRepository $destinosRepository,
        ClientesRepository $clientesRepository,
        ProdutosRepository $produtosRepository,
        ItemPedidoRepository $itempedidosRepository
    )
    {
        $this->repository = $repository;
        $this->origensRepository = $origensRepository;
        $this->destinosRepository = $destinosRepository;
        $this->clientesRepository = $clientesRepository;
        $this->produtosRepository = $produtosRepository;
        $this->itempedidosRepository = $itempedidosRepository;
        $this->repository->pushCriteria(new FindByPedidoEncerradoCriteria());
    }


    /**
     * Display a listing of the resource.
     *pedido
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $tipo = $request->get('tipo');
        if($tipo==""){
            $tipo = 0;
        }

      
        if (Auth::user()->centrodistribuicao_id == 1) {
            if($tipo == 0){
                $pedidos = $this->repository->with(['origem', 'cliente', 'destino'])->paginate(25);
            }else{
                $pedidos = $this->repository->with(['origem', 'cliente', 'destino'])->scopeQuery(function ($query) use ($tipo) {
                    return $query->where('tipo', $tipo)->orderBy('id', 'desc');
                })->paginate(25);
            }
        } else {
            $centrodis = Auth::user()->centrodistribuicao_id;

            if($tipo == 0){
                $pedidos = $this->repository->with(['origem', 'cliente', 'destino'])->scopeQuery(function ($query) use ($centrodis) {
                    return $query->orwhere('origem_id', $centrodis)->orwhere('destino_id', $centrodis)->orderBy('id', 'desc');
                })->paginate(25);
            }else{
                $pedidos = $this->repository->with(['origem', 'cliente', 'destino'])->scopeQuery(function ($query) use ($tipo, $centrodis) {
                    return $query->where('tipo', $tipo)->Where(function ($query) use ($centrodis) {
                        $query->orwhere('origem_id', $centrodis)->orwhere('destino_id', $centrodis);
                    });
                    
                    
                })->paginate(25);
            }
                      
        }

        //dd($pedidos[0]->produtos[0]->produto);

        return view('admin.pedidosencerrados.index', compact('pedidos', 'search'));
    }

    public function cliente(Request $request, $status, $clienteId){
        $search = $request->get('search');
        
        $pedidos = $this->repository->scopeQuery(function($query) use($clienteId) {
            return $query->where('cliente_id', $clienteId);
        })->paginate(25);
        
        $total_rows= $pedidos->count();

        $cliente = $clienteId;
        //dd($clienteId);

        return view('admin.pedidosencerrados.cliente', compact('pedidos', 'search', 'total_rows', 'cliente'));
    }

    public function itempedido(Request $request, $t, $id)
    {
        $search = $request->get('search');

        $pedido = $this->repository->find($id);

        $itenspedido = $this->itempedidosRepository->with(['produto'])->scopeQuery(function ($query) use ($id) {
            return $query->where('pedido_id', $id);
        })->paginate(25);

        if ($itenspedido->isEmpty()) {
            return 'vazio';
        }

        return view('admin.pedidosencerrados.itempedido', compact('itenspedido', 'search', 'pedido'));
    }


    public function details($status, $id, $produtoId)
    {
        $produto = $this->repository->find($id)->produtos->where('produto_id', $produtoId)->first();

        return view('admin.pedidosencerrados.details', compact('produto'));
    }

    public function extornar($status, $pedidoId)
    {
        $pedido['status'] = 1;
        $this->repository->update($pedido, $pedidoId);

        return back()->withInput();
    }

    private function opcao()
    {
        $center_id = \Auth::user()->centrodistribuicao_id;
        switch ($center_id) {
            case 1:
                return ['Entrada' => 'Entrada', 'Movimentação' => 'Movimentação', 'Saída' => 'Saída'];
            case 2:
                return ['Movimentação' => 'Movimentação'];
            case 3:
                return ['Saída' => 'Saída'];
        }
    }
}