<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ItensPedidosRepository
 * @package namespace CorkTech\Repositories;
 */
interface ItensPedidosRepository extends RepositoryInterface
{
    //
    public function findWherePaginate($where, $limit);
}
