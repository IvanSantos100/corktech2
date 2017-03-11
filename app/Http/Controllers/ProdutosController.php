<?php

namespace CorkTeck\Http\Controllers;

use CorkTeck\Http\Requests\ProdutosRequest;
use CorkTeck\Repositories\ProdutosRepository;


class ProdutosController extends Controller
{

    /**
     * @var ProdutosRepository
     */
    protected $repository;


    public function __construct(ProdutosRepository $repository)
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
        $produtos = $this->repository->paginate(10);

        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('admin.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProdutosRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutosRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.produtos.index'));
        $request->session()->flash('message', ' de produto cadastrado com sucesso.');

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
        $produto = $this->repository->find($id);

        return view('admin.produtos.show', compact('produto'));
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

        $produto = $this->repository->find($id);

        return view('admin.produtos.edit', compact('produto'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProdutosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ProdutosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.produtos.index'));
        $request->session()->flash('message', ' de produto cadastrado com sucesso.');

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
        \Session::flash('message', 'Produtos excluída com sucesso.');

        return redirect('admin/produtos');
    }
}
