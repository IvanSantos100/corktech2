<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByPedidoPendenteCriteria;
use CorkTech\Http\Requests\PedidosRequest;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\EstoquesRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ClientesRepository;
use CorkTech\Repositories\ProdutosRepository;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{

    /**
     * @var PedidosRepository
     */
    protected $repository;
    /**
     * @var CentroDistribuicoesRepository
     */
    private $origensRepository;
    /**
     * @var CentrodistribuicoesRepository
     */
    private $destinosRepository;
    /**
     * @var ClientesRepository
     */
    private $clientesRepository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var EstoquesRepository
     */
    private $estoquesRepository;


    public function __construct(
        PedidosRepository $repository,
        CentroDistribuicoesRepository $origensRepository,
        CentroDistribuicoesRepository $destinosRepository,
        ClientesRepository $clientesRepository,
        ProdutosRepository $produtosRepository,
        EstoquesRepository $estoquesRepository
    )
    {
        $this->repository = $repository;
        $this->origensRepository = $origensRepository;
        $this->destinosRepository = $destinosRepository;
        $this->clientesRepository = $clientesRepository;
        $this->produtosRepository = $produtosRepository;

        $this->repository->pushCriteria(new FindByPedidoPendenteCriteria());
        $this->estoquesRepository = $estoquesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if (Auth::user()->centrodistribuicao_id == 1) {
            $pedidos = $this->repository->paginate(10);
        } else {
            $centrodis = Auth::user()->centrodistribuicao_id;
            $pedidos = $this->repository->findOrWherePaginate([['origem_id', '=', $centrodis], ['destino_id', '=', $centrodis]], 10);
        }

        return view('admin.pedidos.index', compact('pedidos', 'search'));
    }

    public function status(Request $request, $pedidoId)
    {
        $pedido = $this->repository->find($pedidoId);

        if($pedido->tipo === 'Entrada') {
            $pedido->produtos()->each(function ($produto ) use($pedido){
                $estoque = ['lote' => $pedido->id,
                            'produto_id' => $produto->produto_id,
                            'valor' => $produto->preco - ($pedido->desconto  ? $produto->preco * ($pedido->desconto/100) : 0)   ,
                            'quantidade' => $produto->quantidade,
                            'centrodistribuicao_id' => $pedido->destino->id
                    ];

                $this->estoquesRepository->create($estoque);
                return $estoque;
            });
        }

        if($pedido->tipo === 'movimentação') {
            $pedido->produtos()->each(function ($produto ) use($pedido){
                $estoque = ['lote' => $pedido->id,
                            'produto_id' => $produto->produto_id,
                            'valor' => $produto->preco - ($pedido->desconto  ? $produto->preco * ($pedido->desconto/100) : 0)   ,
                            'quantidade' => $produto->quantidade,
                            'centrodistribuicao_id' => $pedido->destino->id
                    ];

                $this->estoquesRepository->create($estoque);
                return $estoque;
            });
        }

        $pedido = ['status' => 2];
        $this->repository->update($pedido, $pedidoId);
        $url = $request->get('redirect_to', route('admin.pedidos.index'));
        $request->session()->flash('message', "Pedido {$pedidoId} finalizado.");

        return redirect()->to($url);
    }

    public function create()
    {
        $origens = $this->origensRepository->pluck('descricao', 'id');
        $destinos = $this->destinosRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');
        $opcao = $this->opcao();

        if(\Auth::user()->centrodistribuicao_id==1) {
            $style = [
                "display: none",
                "display: none",
                "display: none"
            ];
        }else{
            $style = [
                "",
                "",
                "display: none"
            ];
        }

        return view('admin.pedidos.create', compact('origens', 'destinos', 'clientes', 'opcao', 'style'));
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
        $data = $request->all();

        //dd($data);
        $data['status'] = 1;
        $data['desconto'] = $data['desconto'] ?? 0;
        $data['forma_pagamento'] = $data['forma_pagamento'] ?? 1;

        //if ($data['tipo'] == 1)
        {
            $data['origem_id'] = null;
            $data['destino_id'] = Auth::user()->centrodistribuicao_id;
        }

        if ($data['tipo'] === 'movimentação') {
            $data['origem_id'] = 1;
            //$data['destino_id'] = 1;
        }

        if ($data['tipo'] === 'saída') {
            //$data['origem_id'] = null;
            $data['destino_id'] = null;
        }

        //dd($data);
        $pedido = $this->repository->create($data);

        return redirect()->route('admin.itenspedido.produtos', ['pedidoId' => $pedido->id]);
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

        $origens = $this->origensRepository->pluck('descricao', 'id')->prepend('NULL', '');
        $destinos = $this->destinosRepository->pluck('descricao', 'id')->prepend('NULL', '');
        $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');

        $opcao = $this->opcao();

        if($pedido['tipo']=='Entrada') {
            $style = [
                "display: none",
                "display: none",
                "display: none"
            ];
        }else if($pedido['tipo']=='Movimentação'){
            $style = [
                "",
                "",
                "display: none"
            ];
        }else if($pedido['tipo']=='Saída'){
            $style = [
                "",
                "display: none",
                ""
            ];
        }

        return view('admin.pedidos.edit', compact('pedido', 'origens', 'destinos', 'clientes', 'opcao', 'style'));
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
        $request->session()->flash('message', ' de pedido cadastrado com sucesso.');

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
        } catch (QueryExceptionception $ex) {
            \Session::flash('error', 'Pedidos não pode ser excluido. Existe produtos relacionados.');
        }

        return redirect('admin/pedidos');
    }

    private function opcao()
    {
        $center_id = \Auth::user()->centrodistribuicao_id;
        switch ($center_id) {
            case 1:
                return ['Entrada' => 'Entrada', 'Movimentação' => 'Movimentação', 'Saída' => 'Saída'];
            default:
                return [ 'Movimentação' => 'Movimentação', 'Saída' => 'Saída'];
        }

    }
}
