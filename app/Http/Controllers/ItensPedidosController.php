<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\itempedidosRequest;
use CorkTech\Repositories\ItemPedidoRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ProdutosRepository;
use Illuminate\Http\Request;

class itempedidosController extends Controller
{

    /**
     * @var ItemPedidoRepository
     */
    protected $repository;
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;

    private $produtosRepository;

    public function __construct(
        ItemPedidoRepository $repository, PedidosRepository $pedidosRepository, ProdutosRepository $produtosRepository
    ){
        $this->repository = $repository;
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pedidorealizado = $request->get('pedido');

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $this->pedidosRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $itempedidos = $this->repository->findWherePaginate([['pedido_id','=',$pedidorealizado]],10);
        $pedido = $this->pedidosRepository->find($pedidorealizado);

        return view('admin.itempedidos.index', compact('itempedidos','search', 'pedido'));
    }

    public function create()
    {
        $pedidos = $this->pedidosRepository->pluck('descricao', 'id');

        return view('admin.itempedidos.create', compact('pedidos') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  itempedidosRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(itempedidosRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.itempedidos.index'));
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

        return view('admin.itempedidos.show', compact('pedido'));
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

        return view('admin.itempedidos.edit', compact('pedido', 'origens', 'destinos', 'clientes', 'opcao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  itempedidosRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(itempedidosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.itempedidos.index'));
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
        \Session::flash('message', 'itempedidos excluída com sucesso.');

        return redirect('admin/itempedidos');
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
