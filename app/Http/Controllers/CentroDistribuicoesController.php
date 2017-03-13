<?php

namespace CorkTeck\Http\Controllers;

use CorkTeck\Http\Requests\CentroDistribuicoesRequest;
use CorkTeck\Repositories\CentroDistribuicoesRepository;
use Illuminate\Database\QueryException;


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
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $centrodistribuicoes = $this->repository->paginate(10);

        return view('admin.centrodistribuicoes.index', compact('centrodistribuicoes'));
    }

    public function create()
    {
        return view('admin.centrodistribuicoes.create');
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

        return view('admin.centrodistribuicoes.edit', compact('centrodistribuicao'));
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
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Centro de distribuicão excluída com sucesso.');
        }catch (QueryException $ex){
            \Session::flash('error', 'Centro de distribuicão não pode ser excluido. Ele está relacionado com outro registro .');
        }

        return redirect('admin/centrodistribuicoes');
    }
}
