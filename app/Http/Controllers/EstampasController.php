<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\EstampasRequest;
use CorkTech\Repositories\EstampasRepository;


class EstampasController extends Controller
{

    /**
     * @var EstampasRepository
     */
    protected $repository;


    public function __construct(EstampasRepository $repository)
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
        $estampas = $this->repository->paginate(10);


        return view('admin.estampas.index', compact('estampas'));
    }

    public function create()
    {
        return view('admin.estampas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstampasRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EstampasRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.estampas.index'));
        $request->session()->flash('message', 'Estampa cadastrado com sucesso.');

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
        $estampa = $this->repository->find($id);

        return view('admin.estampas.show', compact('estampa'));
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

        $estampa = $this->repository->find($id);

        return view('admin.estampas.edit', compact('estampa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EstampasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(EstampasRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.estampas.index'));
        $request->session()->flash('message', 'Estampa cadastrado com sucesso.');

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
        \Session::flash('message', 'Estampas excluída com sucesso.');

        return redirect('admin/estampas');
    }
}
