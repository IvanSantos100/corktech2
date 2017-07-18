<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByPedidoPendenteCriteria;
use CorkTech\Http\Requests\PedidosRequest;
use CorkTech\Models\Pedido;
use CorkTech\Models\Produto;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Repositories\EstoquesRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ClientesRepository;
use CorkTech\Repositories\ProdutosRepository;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        //$this->repository->pushCriteria(new FindByPedidoPendenteCriteria());
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
        /*
        $user = Auth::user()->centrodistribuicao_id;
        if ($user == 1) {
            $pedidos = $this->repository->paginate(10);
        } else {
            $pedidos = $this->repository->scopeQuery(function ($query) use($user){
              return $query->whereOr(['origem_id' => $user, 'destino_id' => $user]);
            })->paginate(10);
        }
        */

        $pedidos = $this->repository->paginate(10);

        //dd($pedidos);

        return view('admin.pedidos.index', compact('pedidos', 'search'));
    }

    public function status(Request $request, $pedidoId)
    {
        $pedido['status'] = 2;
        $this->repository->update($pedido, $pedidoId);
        $url = $request->get('redirect_to', route('admin.pedidos.index'));
        $request->session()->flash('message', "Pedido {$pedidoId} finalizado com sucesso." );

        return redirect()->to($url);


        $error = '';
        $pedidofeito = false;

        $pedido = $this->repository->find($pedidoId);

        //dd($pedido);
        if ($pedido->tipo === 'Entrada') {
            $pedido->produtos()->each(function ($produto) use ($pedido) {
                $estoque = [
                    'lote' => $pedido->id,
                    'produto_id' => $produto->produto_id,
                    'valor' => $produto->preco - ($pedido->desconto ? $produto->preco * ($pedido->desconto / 100) : 0),
                    'quantidade' => $produto->quantidade,
                    'centrodistribuicao_id' => $pedido->destino->id
                ];

                $this->estoquesRepository->create($estoque);
                //return $estoque;
            });

            $pedidofeito = true;
        }

        if ($pedido->tipo === 'Movimentação') {

            $produtos = $pedido->produtos()->get();
            foreach ($produtos as $produto){
                //dd($produto);
                $estoqueproduto = $this->produtosRepository->find($produto->id)->estoques
                    ->where('centrodistribuicao_id', $pedido->origem_id)
                    ->where('lote', $produto->pivot->lote)
                    ->where('quantidade', '>=', $produto->pivot->quantidade);
                //dd($produto, $estoqueproduto);

                if (!$estoqueproduto->isEmpty()) {

                    $valor = $produto->pivot->preco - ($pedido->desconto ? $produto->pivot->preco * ($pedido->desconto / 100) : 0);
                    $estoque = [
                        'lote' => $produto->pivot->lote,
                        'produto_id' => $produto->id,
                        'valor' => $valor,
                        'quantidade' => $produto->pivot->quantidade,
                        'centrodistribuicao_id' => $pedido->destino_id
                    ];

                    //dd($estoque);

                    if ($estoqueproduto->first()->quantidade == $produto->pivot->quantidade) {
                        $this->estoquesRepository->delete($estoqueproduto->first()->id);
                    }

                    if($estoqueproduto->first()->quantidade > $produto->pivot->quantidade){
                        $estoq = ['quantidade' => $estoqueproduto->first()->quantidade - $produto->pivot->quantidade];
                        $this->estoquesRepository->update($estoq, $estoqueproduto->first()->id);
                    }


                    $prodestoque = $this->estoquesRepository->findWhere([
                        'lote'=>$produto->pivot->lote,
                        'valor'=>$valor,
                        'centrodistribuicao_id'=> $pedido->destino_id,
                        'produto_id'=> $produto->id
                    ]);

                    if(!$prodestoque->isEmpty() && $prodestoque->first()->id){
                        $estoque['quantidade'] = $prodestoque->first()->quantidade + $produto->pivot->quantidade;
                        $this->estoquesRepository->update($estoque, $prodestoque->first()->id );
                    }else {
                        $this->estoquesRepository->create($estoque);
                    }

                    $pedidofeito = true;

                } else {

                    $error[] = "Produto <b>{$produto->descricao}</b> com quantidade inferior no estoque<br>";
                }
                if(!empty($error))
                    $error = implode('',$error);
            }
            //dd($b);
            /*
            $pedido->produtos()->each(function ($produto) use ($pedido) {
                //dd($produto);

                $estoqueproduto = $this->produtosRepository->find($produto->produto_id)->estoques
                    ->where('centrodistribuicao_id', $pedido->origem_id)
                    ->where('lote', $produto->lote)
                    ->where('quantidade', '>=', $produto->quantidade);
                //dd($produto, $estoqueproduto);

                if (!$estoqueproduto->isEmpty()) {

                    $estoque = [
                        'lote' => $produto->lote,
                        'produto_id' => $produto->produto_id,
                        'valor' => $produto->preco - ($pedido->desconto ? $produto->preco * ($pedido->desconto / 100) : 0),
                        'quantidade' => $produto->quantidade,
                        'centrodistribuicao_id' => $pedido->destino_id
                    ];

                    if ($estoqueproduto->first()->quantidade == $produto->quantidade) {
                        $this->estoquesRepository->delete($estoqueproduto->first()->id);
                    }

                    if($estoqueproduto->first()->quantidade > $produto->quantidade){
                        $estoq = ['quantidade' => $estoqueproduto->first()->quantidade - $produto->quantidade];
                        $this->estoquesRepository->update($estoq, $estoqueproduto->first()->id);
                    }

                    $this->estoquesRepository->create($estoque);
                    return 1;

                } else {

                    return 0;
                }
            });
            */
        }

        if ($pedido->tipo === 'Saída') {

            $produtos = $pedido->produtos()->get();
            foreach ($produtos as $produto) {
                //dd($produto, $pedido);

                $prodestoque = $this->estoquesRepository->findWhere([
                    'lote'=>$produto->pivot->lote,
                    'centrodistribuicao_id'=> $pedido->origem_id,
                    'produto_id'=> $produto->id
                ]);

                if ($prodestoque->first()->quantidade == $produto->pivot->quantidade) {
                    $this->estoquesRepository->delete($prodestoque->first()->id);
                }

                if($prodestoque->first()->quantidade > $produto->pivot->quantidade){
                    $estoq = ['quantidade' => $prodestoque->first()->quantidade - $produto->pivot->quantidade];
                    $this->estoquesRepository->update($estoq, $prodestoque->first()->id);
                }

            }

            $pedidofeito = true;

        }

        if($pedidofeito) {
            $pedido = ['status' => 2];
            $this->repository->update($pedido, $pedidoId);
            $url = $request->get('redirect_to', route('admin.pedidos.index'));
            //$request->session()->flash('message', "Pedido {$pedidoId} finalizado. <br> {$error}" );

            return redirect()->to($url);
        }

        $url = $request->get('redirect_to', route('admin.pedidos.index'));
        $request->session()->flash('error', "Pedido {$pedidoId} Não finalizado. <br> {$error}");

        return redirect()->to($url);
    }

    public function create(Request $request)
    {
        $origens = $this->origensRepository->pluck('descricao', 'id');
        $destinos = $this->destinosRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');
        $opcao = $this->opcao();

        $tipo = $request->get('tipo') ?: array_keys($opcao)[0];

        return view('admin.pedidos.create', compact('origens', 'destinos', 'clientes', 'opcao', 'tipo'));
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
        $pedido = $this->repository->create($request->all());

        return redirect()->route('admin.itempedido.produtos', ['pedidoId' => $pedido->id]);
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

        if(!$pedido){
            throw new ModelNotFoundException('Pedido não encontrado.');
        }

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

        $origens = $this->origensRepository->pluck('descricao', 'id');
        $destinos = $this->destinosRepository->pluck('descricao', 'id');
        $clientes = $this->clientesRepository->orderBy('nome')->pluck('nome', 'id');
        $opcao = $this->opcao();

        $tipo = $pedido->tipo;

        return view('admin.pedidos.edit', compact('pedido', 'origens', 'destinos', 'clientes', 'opcao', 'tipo'));
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
        $request->session()->flash('message', 'Pedido atualizado com sucesso.');

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
                return  Pedido::TIPO;
            default:
                return  Pedido::TIPO_2;
        }
    }
}
