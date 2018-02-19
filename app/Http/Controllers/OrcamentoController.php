<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Repositories\ItemPedidoRepository;
use CorkTech\Repositories\PedidosRepository;
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
     * OrcamentoController constructor.
     */
    public function __construct(PedidosRepository $pedidosRepository, ItemPedidoRepository $itemPedidoRepository)
    {
        $this->pedidosRepository = $pedidosRepository;
        $this->itemPedidoRepository = $itemPedidoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
