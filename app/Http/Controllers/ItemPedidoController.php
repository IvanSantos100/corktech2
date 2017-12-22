<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Criteria\FindByProdutosCriteria;
use CorkTech\Repositories\ItemPedidoRepository;
use CorkTech\Repositories\PedidosRepository;
use CorkTech\Repositories\ProdutosRepository;
use CorkTech\Repositories\TipoProdutosRepository;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{


    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var ItemPedidoRepository
     */
    private $repository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var TipoProdutosRepository
     */
    private $tipoProdutosRepository;

    public function __construct(
        ItemPedidoRepository $repository,
        PedidosRepository $pedidosRepository,
        ProdutosRepository $produtosRepository,
        TipoProdutosRepository $tipoProdutosRepository
    )
    {
        $this->repository = $repository;
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
        $this->tipoProdutosRepository = $tipoProdutosRepository;
    }

    public function index(Request $request, $pedidoId)
    {
        $pedido = $this->pedidosRepository->find($pedidoId);

        $itens_pedidos = $this->repository->with(['produto'])->scopeQuery(function ($query) use ($pedidoId) {
            return $query->where('pedido_id', $pedidoId);
        })->paginate(25);

        //dd($itens_pedidos, $pedido);

        if ($itens_pedidos->isEmpty()) {
            return redirect()->route('admin.itempedido.produtos', ['pedido' => $pedidoId]);
        }
        //dd($itens_pedidos[0]->preco);

        return view('admin.itempedido.index', compact('itens_pedidos', 'pedidoId', 'pedido'));
    }

    public function listarProdutos(Request $request, $pedidoId)
    {
        $search = explode(':', $request->get('search'));

        $pedido = $this->pedidosRepository->resetCriteria()->find($pedidoId);

        $tipo = $this->tipoProdutosRepository->resetCriteria()->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->all();

        $this->produtosRepository->pushCriteria(new FindByProdutosCriteria($pedidoId, $this->pedidosRepository));

        $produtos = $this->produtosRepository->scopeQuery(function ($query) {
            return $query->orderBy('descricao', 'asc');
        })->paginate(25);

        return view('admin.itempedido.produtos', compact('produtos', 'pedido', 'search', 'tipo'));
    }

    public function addProdudo(Request $request, $pedidoId)
    {
        foreach ($request->quantidade as $key => $qnt) {
            if ($qnt > 0) {
                $this->repository->create([
                    'pedido_id' => $pedidoId,
                    'produto_id' => $request->produto_id,
                    'lote' => $request->lote[$key],
                    'quantidade' => $qnt,
                ]);
            }
        }

        $url = $request->get('redirect_to', route('admin.itempedido.produtos', ['pedidoId' => $pedidoId]));
        if (!$request->session()->has('message')) {
            $request->session()->flash('error', "Produto não incluido.");
        }

        return redirect()->to($url);
    }

    public function details($pedido, $id)
    {
        $produto = $this->produtosRepository->find($id);

        return view('admin.itempedido.show', compact('produto'));
    }

    public function editProdudo($pedidoId, $produtoId)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $itemPedido = $this->repository->update(['quantidade' => $request->quantidade], $id);
        $itemPedido = $this->repository->find($id);

        return redirect()->route('admin.itempedido.index', ['pedido' => $itemPedido->pedido_id])->with('message', "Produto atualizado");
    }

    public function deleteProduto($pedidoId, $itempedido)
    {
        $pedido = $this->repository->delete($itempedido);

        if ($pedido == 1) {
            \Session::flash('message', 'Produto excluído.');
        } else {
            \Session::flash('error', 'Produto não excluído.');
        }

        return redirect()->route('admin.itempedido.index', ['pedidoId' => $pedidoId]);
    }
}
