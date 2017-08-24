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
    ){
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

        if(Auth::user()->centrodistribuicao_id==1){
            $pedidos = $this->repository->paginate(10);
        }else {
            $centrodis = Auth::user()->centrodistribuicao_id;
            $pedidos = $this->repository->findOrWherePaginate([['origem_id', '=', $centrodis], ['destino_id', '=', $centrodis]], 10);
        }

        //dd($pedidos[0]->produtos[0]->produto);

        return view('admin.pedidosencerrados.index', compact('pedidos','search'));
    }

    public function itempedido(Request $request, $t, $id)
    {
        $search = $request->get('search');

        ///$this->produtosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $itenspedido = $this->repository->find($id)->produtos()->paginate(10);

        if ($itenspedido->isEmpty()) {

            return 'vazio';
        }

        return view('admin.pedidosencerrados.itempedido', compact('itenspedido', 'search'));
    }


    public function details($status, $id, $produtoId)
    {
        $produto = $this->repository->find($id)->produtos->where('produto_id', $produtoId)->first()->produto;

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
        switch ($center_id){
            case 1: return ['Entrada' => 'Entrada', 'Movimentação' => 'Movimentação', 'Saída' => 'Saída'];
            case 2: return ['Movimentação' => 'Movimentação'];
            case 3: return ['Saída' => 'Saída'];
        }

    }


}