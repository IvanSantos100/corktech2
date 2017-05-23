<?php

namespace CorkTech\Criteria;

use CorkTech\Models\ItemPedido;
use CorkTech\Models\Pedido;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByProdutosCriteria
 * @package namespace CorkTech\Criteria;
 */
class FindByProdutosCriteria implements CriteriaInterface
{
    /**
     * @var
     */
    private $pedidoId;
    /**
     * @var
     */
    private $tipo;

    function __construct($pedidoId, $tipo)
    {
        $this->pedidoId = $pedidoId;
        $this->tipo = $tipo;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {

        /*
        $produtos = PedidosRepository->scopeQuery(function ($query){
            return $query->find(1)->produtos()->orderBy('id')->get();
        });

        $produtos = Pedido::find($this->pedidoId)
            ->produtos()
            ->get()
            ->map(function ($query) {
                return $query['id'];
            });
        */

        if ($this->tipo) {

            $produtos = Pedido::find($this->pedidoId)
                ->produtos()
                ->get()
                ->pluck('id');

            return $model->whereNotIn('produtos.id', $produtos->all());
        }
        /*
        $estoque = \DB::table('estoques')
            ->join('itens_pedidos','estoques.produto_id', '=', 'itens_pedidos.produto_id')
            ->where('itens_pedidos.pedido_id', '=', 3)
            ->where('estoques.lote', '=', 'itens_pedidos.lote')
            ->pluck('estoques.id');
        */

        $estoque = ItemPedido::where('pedido_id', $this->pedidoId)
            ->join('estoques', function ($join) {
                $join->on('itens_pedidos.produto_id', '=', 'estoques.produto_id')
                    ->on('itens_pedidos.lote', '=', 'estoques.lote');
            })
            ->get()
            ->pluck('id');

        return $model->whereNotIn('estoques.id', $estoque->all());

    }
}
