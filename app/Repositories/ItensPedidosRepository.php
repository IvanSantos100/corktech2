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

    public function delItemLote($perido_id, $produto_id, $lote);
}
