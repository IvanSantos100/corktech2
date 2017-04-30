<?php

namespace CorkTech\Criteria;

use CorkTech\Models\Pedido;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByProdutoEstoque
 * @package namespace CorkTech\Criteria;
 */
class FindByProdutoEstoque implements CriteriaInterface
{

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

        $user = \Auth::user()->centrodistribuicao_id;

        /*
        $m = $model->join('estoques', 'produtos.id', '=', 'estoques.produto_id')
            ->where('estoques.centrodistribuicao_id', 1)
            ->where('estoques.quantidade', '>', 0)
            ->select('estoques.produto_id')->get();

        $m = $m->map(function ($values) {
            return $values->produto_id;
        });

        */



        return $model->whereIn('produtos.id', $m->all());
    }
}
