<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\ProdutosRequest;
use CorkTech\Repositories\ClassesRepository;
use CorkTech\Repositories\EstampasRepository;
use CorkTech\Repositories\ProdutosRepository;
use CorkTech\Repositories\TipoProdutosRepository;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $search = $request->get('search');

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $produtos = $this->repository->orderBy('descricao')->paginate(25);

        return view('admin.produtos.index', compact('produtos','search'));
    }

    public function create()
    {
        $estampas = $this->estampasRepository->orderBy('descricao','asc')->pluck('descricao', 'id');
        $classes = $this->classesRepository->orderBy('descricao')->pluck('descricao', 'id');
        $tipoprodutos = $this->tipoProdutosRepository->orderBy('descricao')->pluck('descricao', 'id');

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
        $estampas = $this->estampasRepository->orderBy('descricao')->pluck('descricao', 'id');
        $classes = $this->classesRepository->orderBy('descricao')->pluck('descricao', 'id');
        $tipoprodutos = $this->tipoProdutosRepository->orderBy('descricao')->pluck('descricao', 'id');

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
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Produtos excluída com sucesso.');
        $url = $request->get('redirect_to', route('admin.produtos.index'));

        return redirect()->to($url);
    }
}
