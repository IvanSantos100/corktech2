<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\ClientesRequest;
use CorkTech\Repositories\ClientesRepository;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\TipoClientesRepository;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    /**
     * @var ClientesRepository
     */
    protected $repository;

    private $centroDistribuicoesRepository;

    public function __construct(ClientesRepository $repository, CentroDistribuicoesRepository $centroDistribuicoesRepository){
        $this->repository = $repository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $clientes = $this->repository->orderBy('nome')->paginate(25);

        $clientes->each(function ($item, $key) {
            $item->tipo = $this->opcao($item->tipo);
        });


        return view('admin.clientes.index', compact('clientes','search'));
    }

    public function create(Request $request)
    {
        $opcao = [1 => 'Física'];

        if($request->cnpj)
            $opcao = [2 => 'Jurídica'];

        return view('admin.clientes.create', compact('opcao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClientesRequest $request)
    {
        $data = $request->all();
        $data['senha'] = bcrypt($request->documento);
        $data['centrodistribuicao_id'] = \Auth::user()->centrodistribuicao_id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('admin.clientes.index'));
        $request->session()->flash('message', 'Cliente cadastrado com sucesso.');

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
        $cliente = $this->repository->find($id);

        $cliente->tipo = $this->opcao($cliente->tipo);

        return view('admin.clientes.show', compact('cliente'));
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
        $cliente = $this->repository->find($id);

        $opcao = [1 => 'Física'];

        if($cliente->tipo == 2)
            $opcao = [2 => 'Jurídica'];

        return view('admin.clientes.edit', compact('cliente', 'opcao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ClientesRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ClientesRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.clientes.index'));
        $request->session()->flash('message', ' Cliente atualizado com sucesso.');

        return redirect()->to($url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);
        $url = $request->get('redirect_to', route('admin.clientes.index'));
        \Session::flash('message', 'Clientes excluída com sucesso.');

        return redirect()->to($url);
    }

    private function opcao($p)
    {
        switch ($p){
            case 1 : return 'Física'; break;
            case 2 : return 'Jurídica'; break;
        }
    }
}
