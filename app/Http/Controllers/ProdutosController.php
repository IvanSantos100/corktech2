<?php

namespace CorkTeck\Http\Controllers;

use CorkTeck\Http\Requests\ProdutosRequest;
use CorkTeck\Repositories\ClassesRepository;
use CorkTeck\Repositories\EstampasRepository;
use CorkTeck\Repositories\ProdutosRepository;
use CorkTeck\Repositories\TipoProdutosRepository;


class ProdutosController extends Controller
{

    /**
     * @var ProdutosRepository
     */
    protected $repository;
    /**
     * @var EstampasRepository
     */
    private $estampasRepository;
    /**
     * @var ClassesRepository
     */
    private $classesRepository;
    /**
     * @var TipoProdutosRepository
     */
    private $tipoProdutosRepository;


    public function __construct(
        ProdutosRepository $repository,
        EstampasRepository $estampasRepository,
        ClassesRepository $classesRepository,
        TipoProdutosRepository $tipoProdutosRepository
    ){
        $this->repository = $repository;
        $this->estampasRepository = $estampasRepository;
        $this->classesRepository = $classesRepository;
        $this->tipoProdutosRepository = $tipoProdutosRepository;
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
        $estampas = $this->estampasRepository->pluck('descricao', 'id');
        $classes = $this->classesRepository->pluck('tamanho', 'id');
        $tipoprodutos = $this->tipoProdutosRepository->pluck('descricao', 'id');

        return view('admin.produtos.create', compact('estampas', 'classes', 'tipoprodutos') );
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
        $request->session()->flash('message', 'Produto cadastrado com sucesso.');

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
        $estampas = $this->estampasRepository->pluck('descricao', 'id');
        $classes = $this->classesRepository->pluck('tamanho', 'id');
        $tipoprodutos = $this->tipoProdutosRepository->pluck('descricao', 'id');

        return view('admin.produtos.edit', compact('produto', 'estampas', 'classes', 'tipoprodutos'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProdutosRequest $request
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
