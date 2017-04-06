<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\EstoquesRequest;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\EstoquesRepository;
use CorkTech\Repositories\ProdutosRepository;
use Illuminate\Database\QueryException;


class EstoquesController extends Controller
{

    /**
     * @var EstoquesRepository
     */
    protected $repository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var CentroDistribuicoesRepository
     */
    private $centroDistribuicoesRepository;

    public function __construct(
        EstoquesRepository $repository,
        ProdutosRepository $produtosRepository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository
    ) {
        $this->repository = $repository;
        $this->produtosRepository = $produtosRepository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $estoques = $this->repository->paginate(10);

        return view('admin.estoques.index', compact('estoques'));
    }

    public function create()
    {
        $produtos = $this->produtosRepository->pluck('descricao', 'id');
        $centrodistribuicoes = $this->centroDistribuicoesRepository->pluck('descricao', 'id');

        return view('admin.estoques.create', compact('produtos', 'centrodistribuicoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstoquesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EstoquesRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.estoques.index'));
        $request->session()->flash('message', 'Estoque cadastrado com sucesso.');

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
        $estoque = $this->repository->find($id);

        return view('admin.estoques.show', compact('estoque'));
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
        $estoque = $this->repository->find($id);
        $produtos = $this->produtosRepository->pluck('descricao', 'id');
        $centrodistribuicoes = $this->centroDistribuicoesRepository->pluck('descricao', 'id');

        return view('admin.estoques.edit', compact('estoque', 'produtos', 'centrodistribuicoes' ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EstoquesRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(EstoquesRequest $request, $id)
    {

        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.estoques.index'));
        $request->session()->flash('message', 'Estoque atualizada com sucesso.');

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
            \Session::flash('message', 'Estoque excluída com sucesso.');
        }catch (QueryException $ex){
            \Session::flash('error', 'Estoque não pode ser excluido. Ele está relacionado com outro registro .');
        }

        return redirect('admin/estoques');
    }
}
