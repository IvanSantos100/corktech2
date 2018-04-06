<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Repositories\ClientesRepository;
use CorkTech\Repositories\EstoquesRepository;
use CorkTech\Repositories\ItemPedidoRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ProdutosRepository;
use CorkTech\Repositories\TipoProdutosRepository;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var ItemPedidoRepository
     */
    private $itemPedidoRepository;
    /**
     * @var EstoquesRepository
     */
    private $estoquesRepository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var TipoProdutosRepository
     */
    private $tipoProdutosRepository;
    /**
     * @var ClientesRepository
     */
    private $clientesRepository;

    /**
     * OrcamentoController constructor.
     */
    public function __construct(
        PedidosRepository $pedidosRepository,
        ItemPedidoRepository $itemPedidoRepository,
        EstoquesRepository $estoquesRepository,
        ProdutosRepository $produtosRepository,
        TipoProdutosRepository $tipoProdutosRepository,
        ClientesRepository $clientesRepository
    )
    {
        $this->pedidosRepository = $pedidosRepository;
        $this->itemPedidoRepository = $itemPedidoRepository;
        $this->estoquesRepository = $estoquesRepository;
        $this->produtosRepository = $produtosRepository;
        $this->tipoProdutosRepository = $tipoProdutosRepository;
        $this->clientesRepository = $clientesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $orcamentos = $this->pedidosRepository->with(['origem', 'cliente', 'destino'])->scopeQuery(function ($query) {
            return $query->whereIn('tipo', [4])
                ->orderBy('id', 'desc');
        })->paginate();

        return view('admin.orcamento.index', compact('orcamentos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orcamento = $this->pedidosRepository->create([
            'tipo' => 4,
            'forma_pagamento' => 'Orcamento',
            'origem_id' => \Auth::user()->centrodistribuicao_id,
        ]);

        return redirect()->route('admin.orcamento.additens', ['orcamento' =>$orcamento->id]);
    }

    public function addItens(Request $request, $id)
    {
        $search = explode(':', $request->get('search'));

        $tipo = $this->tipoProdutosRepository->resetCriteria()->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->all();

        $orcamento = $this->pedidosRepository->resetCriteria()->with(['produtos'])->find($id);

        $produtos = $this->produtosRepository
            ->scopeQuery(function ($query) use ($orcamento) {
                return $query->orderBy('descricao', 'asc')
                    ->with('estoques', 'estampas', 'classes', 'tipoprodutos', 'pedidos')
                    ->whereNotIn('id', $orcamento->produtos->pluck('produto_id')->toArray());
            })->paginate();

        return view('admin.orcamento.additens', compact('produtos', 'orcamento', 'search', 'tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeItens(Request $request, $id)
    {
        //dd($request->all());
        if ($request->quantidade > 0) {
            $this->itemPedidoRepository->create([
                'pedido_id' => $id,
                'produto_id' => $request->produto_id,
                'quantidade' => $request->quantidade
            ]);

            return redirect()->route('admin.orcamento.additens', ['orcamento' =>$id])
                ->with('message', 'Produto incluido com sucesso.');
        }

        return redirect()->route('admin.orcamento.additens', ['orcamento' =>$id])
            ->with('error', "Produto não incluido.");
    }

    public function storeCliente(Request $request)
    {
        $this->pedidosRepository->update(
            $request->all(), $request->pedido
        );

        return redirect()->route('admin.orcamento.itens', ['orcamento' => $request->pedido]);
    }


    public function verItens(Request $request, $id)
    {
        $search = $request->get('search');

        $itens = $this->itemPedidoRepository->with(['produto.classes','produto.estampas', 'pedido.cliente', 'pedido.origem'])
            ->scopeQuery(function ($query) use ($id) {
                return $query->where('pedido_id', $id);
            })->paginate();
        //dd($itens->all());
        if ($itens->isEmpty()) {
            return redirect()->route('admin.orcamento.additens', ['orcamento' => $id]);
        }

        $clientes = $this->clientesRepository->scopeQuery(function ($query) use ($itens){
            return $query->where('centrodistribuicao_id', $itens->first()->pedido->origem_id);
        })->orderBy('nome')->all()->pluck('nome', 'id');

        return view('admin.orcamento.itens', ['itens' => $itens, 'search' => $search, 'clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateItem(Request $request, $id)
    {
        $this->itemPedidoRepository->update(['quantidade' => $request->quantidade], $id);
        $itemPedido = $this->itemPedidoRepository->find($id);

        return redirect()->route('admin.orcamento.itens', ['orcamento' => $itemPedido->pedido_id])->with('message', "Produto atualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $orcamento = $this->pedidosRepository->delete($id);
    
         if( $orcamento) {
             return redirect()->route('admin.orcamento.index')
                 ->with('message', 'Orçamento excluída com sucesso.');
         }

        return redirect()->route('admin.orcamento.index')
            ->with('error', 'Orçamento não pode ser excluido. Existe produtos relacionados.');
    }

    public function deleteItem($orcamento, $pedidoId)
    {
        $pedido = $this->itemPedidoRepository->delete($pedidoId);

        if ($pedido) {
            return redirect()->route('admin.orcamento.itens', ['orcamento' => $orcamento])
                ->with('message', 'Produto excluído.');
        }

        return redirect()->route('admin.orcamento.itens', ['orcamento' => $orcamento])
            ->with('error', 'Produto não excluído.');

    }
}
