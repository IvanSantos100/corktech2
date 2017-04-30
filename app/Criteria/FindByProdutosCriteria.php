<?php

namespace CorkTech\Criteria;

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

        /*
        $produtos = PedidosRepository->scopeQuery(function ($query){
            return $query->find(1)->produtos()->orderBy('id')->get();
        });
        */

        $produtos = Pedido::find($this->pedidoId)
            ->produtos()
            ->get()
            ->map(function ($query) {
                return $query['id'];
            });

        return $model->whereNotIn('produtos.id', $produtos->all());
    }
}
