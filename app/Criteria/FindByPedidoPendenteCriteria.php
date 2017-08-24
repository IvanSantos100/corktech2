<?php

namespace CorkTech\Criteria;

use CorkTech\Models\Pedido;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByPedidoPendenteCriteria
 * @package namespace CorkTech\Criteria;
 */
class FindByPedidoPendenteCriteria implements CriteriaInterface
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

        if($user == 1 ){
            return $model->where('status', 1);
        }

        return $model->where(['status' => 1])->where(function($query) use($user) {
            return $query->where(['origem_id' => $user])->orWhere(['destino_id' => $user]);
        });

    }
}
