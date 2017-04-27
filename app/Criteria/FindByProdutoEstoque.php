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

        $model = $repository->visible('id')->with('produtos')->find($user)->get();

        dd($model);
        return $model->where('asd', 1);
    }
}
