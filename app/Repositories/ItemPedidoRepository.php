<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface itempedidosRepository
 * @package namespace CorkTech\Repositories;
 */
interface ItemPedidoRepository extends RepositoryInterface
{
    //
    public function findWherePaginate($where, $limit);

}
