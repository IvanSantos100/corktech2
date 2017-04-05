<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\PedidosRequest;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ClientesRepository;


class PedidosController extends Controller
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


    public function __construct(
        PedidosRepository $repository,
        CentroDistribuicoesRepository $origensRepository,
        CentroDistribuicoesRepository $destinosRepository,
        ClientesRepository $clientesRepository
    ){
        $this->repository = $repository;
        $this->origensRepository = $origensRepository;
        $this->destinosRepository = $destinosRepository;
        $this->clientesRepository = $clientesRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $pedidos = $this->repository->paginate(10);

        $pedidos->each(function ($item, $key) {
            $item->tipo = $this->opcao($item->tipo);
        });

        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $origens = $this->origensRepository->pluck('descricao', 'id');
        $destinos = $this->destinosRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->pluck('nome', 'id');

        $opcao = [1 => 'Entrada', 2 => 'Movimentação', 3 => 'Saída'];

        return view('admin.pedidos.create', compact('origens', 'destinos', 'clientes', 'opcao') );
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
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.pedidos.index'));
        $request->session()->flash('message', 'Pedido cadastrado com sucesso.');

        return redirect()->to($url);
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

        $pedido->tipo = $this->opcao($pedido->tipo);

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
        $origens = $this->origensRepository->pluck('descricao', 'id');
        $destinos = $this->destinosRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->pluck('nome', 'id');
        $opcao = [1 => 'Entrada', 2 => 'Movimentação', 3 => 'Saída'];

        return view('admin.pedidos.edit', compact('pedido', 'origens', 'destinos', 'clientes', 'opcao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PedidosRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PedidosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.pedidos.index'));
        $request->session()->flash('message', ' de pedido cadastrado com sucesso.');

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
        $this->repository->delete($id);
        \Session::flash('message', 'Pedidos excluída com sucesso.');

        return redirect('admin/pedidos');
    }

    private function opcao($p)
    {
        switch ($p){
            case 1 : return 'Entrada'; break;
            case 2 : return 'Movimentação'; break;
            case 3 : return 'Saída';
        }
    }
}
