<?php
/**
 * Created by PhpStorm.
 * User: denis.campos
 * Date: 25/04/2017
 * Time: 12:16
 */

namespace CorkTech\Criteria;

use CorkTech\Models\Pedido;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;


class FindByPedidoEncerradoCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {

        //$user = \Auth::user()->centrodistribuicao_id;

        return $model->where('status','=', 2);
    }

}