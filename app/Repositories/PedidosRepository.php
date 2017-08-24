<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PedidosRepository
 * @package namespace CorkTech\Repositories;
 */
interface PedidosRepository extends RepositoryInterface
{
    //
    public function findWherePaginate($where, $limit);

    public function findOrWherePaginate($where, $limit);

    public function updateValorPedido($pedidoId);
}
