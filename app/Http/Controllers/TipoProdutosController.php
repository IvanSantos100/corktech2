<?php

namespace CorkTeck\Http\Controllers;

use CorkTeck\Http\Requests\TipoProdutosRequest;
use CorkTeck\Repositories\TipoProdutosRepository;


class TipoProdutosController extends Controller
{

    /**
     * @var TipoProdutosRepository
     */
    protected $repository;


    public function __construct(TipoProdutosRepository $repository)
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
        $tipoprodutos = $this->repository->paginate(10);


        return view('admin.tipoprodutos.index', compact('tipoprodutos'));
    }

    public function create()
    {
        return view('admin.tipoprodutos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoProdutosRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TipoProdutosRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.tipoprodutos.index'));
        $request->session()->flash('message', 'Tipo de produto cadastrado com sucesso.');

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
        $tipoproduto = $this->repository->find($id);

        return view('admin.tipoprodutos.show', compact('tipoproduto'));
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

        $tipoproduto = $this->repository->find($id);

        return view('admin.tipoprodutos.edit', compact('tipoproduto'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  TipoProdutosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(TipoProdutosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.tipoprodutos.index'));
        $request->session()->flash('message', 'Tipo de produto cadastrado com sucesso.');

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
        \Session::flash('message', 'TipoProdutos excluída com sucesso.');

        return redirect('admin/tipoprodutos');
    }
}
