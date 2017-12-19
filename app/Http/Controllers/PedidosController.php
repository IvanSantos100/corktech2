<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\PedidosRequest;
use CorkTech\Models\Pedido;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ClientesRepository;
use CorkTech\Repositories\ItemPedidoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * @var PedidosRepository
     */
    protected $repository;
    /**
     * @var CentroDistribuicoesRepository
     */
    private $centroDistribuicoesRepository;
    /**
     * @var ClientesRepository
     */
    private $clientesRepository;
    private $itempedidosRepository;

    public function __construct(
        PedidosRepository $repository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository,
        ClientesRepository $clientesRepository,
        ItemPedidoRepository $itempedidosRepository
    )
    {
        $this->repository = $repository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
        $this->clientesRepository = $clientesRepository;
        $this->itempedidosRepository = $itempedidosRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $tipo = $request->get('tipo');
        if($tipo==""){
            $tipo = 0;
        }

        if($tipo == 0){

            $pedidos = $this->repository->with(['origem', 'cliente', 'destino'])->scopeQuery(function ($query) {
                return $query->orderBy('id', 'desc');
            })->paginate(25);

        }else{

            $pedidos = $this->repository->with(['origem', 'cliente', 'destino'])->scopeQuery(function ($query) use ($tipo) {
                return $query->where('tipo', $tipo)->orderBy('id', 'desc');
            })->paginate(25);

        }

        return view('admin.pedidos.index', compact('pedidos', 'search'));
    }

    public function cliente(Request $request, $clienteId){
        $search = $request->get('search');
        
       // $pedidos = $this->repository->findWherePaginate([['cliente_id','=',$clienteId]],25);

        $pedidos = $this->repository->scopeQuery(function($query) use($clienteId) {
            return $query->where('cliente_id', $clienteId);
        })->paginate(25);
        
        $total_rows= $pedidos->count();

        $cliente = $clienteId;
        //dd($clienteId);

        return view('admin.pedidos.cliente', compact('pedidos', 'search', 'total_rows', 'cliente'));
    }

    public function itempedido(Request $request, $id)
    {
        $search = $request->get('search');

        $pedido = $this->repository->find($id);

        $itenspedido = $this->itempedidosRepository->with(['produto'])->scopeQuery(function ($query) use ($id) {
            return $query->where('pedido_id', $id);
        })->paginate(25);

        if ($itenspedido->isEmpty()) {
            return 'vazio';
        }

        return view('admin.pedidos.itempedido', compact('itenspedido', 'search', 'pedido'));
    }

    public function status(Request $request, $pedidoId)
    {
        $pedido['status'] = 2;
        $this->repository->update($pedido, $pedidoId);

        $url = $request->get('redirect_to', route('admin.pedidos.index'));

        return redirect()->to($url);
    }

    public function create(Request $request)
    {
        $centroDistribuicao = $this->centroDistribuicoesRepository->pluck('descricao', 'id');
        $centrodis = \Auth::user()->centrodistribuicao_id;
        if($centrodis == 1 ){
            $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');
        }else{

            $clientes = $this->clientesRepository->scopeQuery(function ($query) use ($centrodis){
                return $query->select('id', 'nome')
                    ->where('centrodistribuicao_id', $centrodis)
                    ->orderBy('nome');
            });
            
        }
        dd($clientes);

        $opcao = $this->opcao();

        $tipo = $request->get('tipo') ?: array_keys($opcao)[0];

        return view('admin.pedidos.create', compact('centroDistribuicao', 'clientes', 'opcao', 'tipo'));
    }

    private function opcao()
    {
        $center_id = \Auth::user()->centrodistribuicao_id;
        switch ($center_id) {
            case 1:
                return Pedido::TIPO;
            default:
                return Pedido::TIPO_2;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PedidosRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PedidosRequest $request)
    {
        if(trim($request->get('desconto'))==""){
            $request['desconto'] = 0;
        }
        if(trim($request->get('forma_pagamento'))==""){
            $request['forma_pagamento'] = 'À VISTA';
        }
        
        $pedido = $this->repository->create($request->all());

        return redirect()->route('admin.itempedido.produtos', ['pedidoId' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = $this->repository->find($id);

        if (!$pedido) {
            throw new ModelNotFoundException('Pedido não encontrado.');
        }

        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = $this->repository->find($id);

        $centroDistribuicao = $this->centroDistribuicoesRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');
        $opcao = $this->opcao();

        $tipo = $pedido->tipo;

        return view('admin.pedidos.edit', compact('pedido', 'centroDistribuicao', 'clientes', 'opcao', 'tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PedidosRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(PedidosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.pedidos.index'));
        $request->session()->flash('message', 'Pedido atualizado com sucesso.');

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Pedidos excluída com sucesso.');
        } catch (QueryException $ex) {
            \Session::flash('error', 'Pedidos não pode ser excluido. Existe produtos relacionados.');
        }

        return redirect('admin/pedidos');
    }
}
