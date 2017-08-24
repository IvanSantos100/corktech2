<?php

namespace CorkTech\Criteria;

use CorkTech\Models\ItemPedido;
use CorkTech\Models\Pedido;
use CorkTech\Repositories\PedidosRepository;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByProdutosCriteria
 * @package namespace CorkTech\Criteria;
 */
class FindByProdutosCriteria implements CriteriaInterface
{


    /**
     * @var PedidosRepository
     */
    private $repository;
    /**
     * @var
     */
    private $pedidoId;

    function __construct($pedidoId, PedidosRepository $repository)
    {
        $this->repository = $repository;
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
        $produtosId = $this->repository->find($this->pedidoId)->produtos->pluck('produto_id');
        /*$estoque = ItemPedido::where('pedido_id', $this->pedidoId)
            ->join('estoques', function ($join) {
                $join->on('itens_pedidos.produto_id', '=', 'estoques.produto_id')
                    ->on('itens_pedidos.lote', '=', 'estoques.lote');
            })
            ->get()
            ->pluck('id');*/
        //dd($produtosId);
        return $model->whereNotIn('id', $produtosId->all());

    }
}
