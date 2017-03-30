<?php

namespace CorkTeck\Http\Controllers;

use CorkTeck\Repositories\ItensPedidosRepository;
use Illuminate\Http\Request;
use CorkTeck\Repositories\PedidosRepository;
use CorkTeck\Repositories\ProdutosRepository;


class ItensPedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;

    public function __construct(
        ItensPedidosRepository $repository,
        ProdutosRepository $produtosRepository,
        PedidosRepository $pedidosRepository
    ){
        $this->repository = $repository;
        $this->produtosRepository = $produtosRepository;
        $this->pedidosRepository = $pedidosRepository;
    }


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
        //
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
