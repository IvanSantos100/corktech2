<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\CentroDistribuicoesRequest;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class CentroDistribuicoesController extends Controller
{

    /**
     * @var CentroDistribuicoesRepository
     */
    protected $repository;

    public function __construct(CentroDistribuicoesRepository $repository)
    {
        $this->repository = $repository;
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
        $centrodistribuicoes = $this->repository->paginate(10);

        $centrodistribuicoes->each(function ($item, $key) {
            $item->tipo = $this->opcao($item->tipo);
        });

        return view('admin.centrodistribuicoes.index', compact('centrodistribuicoes','search'));
    }

    public function create()
    {
        $opcao = [1 => 'Nacional', 2 => 'Distribuidora', 3 => 'Revenda'];
        return view('admin.centrodistribuicoes.create', compact('opcao','search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CentroDistribuicoesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CentroDistribuicoesRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.centrodistribuicoes.index'));
        $request->session()->flash('message', 'Centro de distribuicão cadastrado com sucesso.');

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
        $centrodistribuicao = $this->repository->find($id);

        $centrodistribuicao->tipo = $this->opcao($centrodistribuicao->tipo);


        return view('admin.centrodistribuicoes.show', compact('centrodistribuicao'));
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
        $centrodistribuicao = $this->repository->find($id);

        $opcao = [1 => 'Nacional', 2 => 'Distribuidora', 3 => 'Revenda'];
        return view('admin.centrodistribuicoes.edit', compact('centrodistribuicao', 'opcao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CentroDistribuicoesRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(CentroDistribuicoesRequest $request, $id)
    {

        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.centrodistribuicoes.index'));
        $request->session()->flash('message', 'Centro de distribuicão atualizada com sucesso.');

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
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Centro de distribuicão excluída com sucesso.');
        }catch (QueryException $ex){
            \Session::flash('error', 'Centro de distribuicão não pode ser excluido. Ele está relacionado com outro registro .');
        }
        $url = $request->get('redirect_to', route('admin.centrodistribuicoes.index'));


        return redirect()->to($url);
    }

    private function opcao($p)
    {
        switch ($p){
            case 1 : return 'Nacional'; break;
            case 2 : return 'Distribuidora'; break;
            case 3 : return 'Revenda';
        }
    }
}
