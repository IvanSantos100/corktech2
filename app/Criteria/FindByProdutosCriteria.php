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

    function __construct($pedidoId)
    {
        $this->pedidoId = $pedidoId;
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
