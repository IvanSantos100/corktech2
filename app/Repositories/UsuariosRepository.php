<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UsuariosRepository
 * @package namespace CorkTech\Repositories;
 */
interface UsuariosRepository extends RepositoryInterface
{
    //
    public function findWherePaginate($where, $limit);
}
