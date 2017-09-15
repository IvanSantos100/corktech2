<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\PedidosRequest;
use CorkTech\Models\Pedido;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ClientesRepository;
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

    public function __construct(
        PedidosRepository $repository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository,
        ClientesRepository $clientesRepository
    )
    {
        $this->repository = $repository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
        $this->clientesRepository = $clientesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pedidos = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','desc');
        })->paginate(10);

        ///dd($pedidos[0]->cliente->nome);

        return view('admin.pedidos.index', compact('pedidos', 'search'));
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
        $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');
        $opcao = $this->opcao();

        $tipo = $request->get('tipo') ?: array_keys($opcao)[0];

        return view('admin.pedidos.create', compact('centroDistribuicao', 'clientes', 'opcao', 'tipo'));
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

        if(!$pedido){
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

    private function opcao()
    {
        $center_id = \Auth::user()->centrodistribuicao_id;
        switch ($center_id) {
            case 1:
                return  Pedido::TIPO;
            default:
                return  Pedido::TIPO_2;
        }
    }
}
