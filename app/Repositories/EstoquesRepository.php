<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface EstoquesRepository
 * @package namespace CorkTech\Repositories;
 */
interface EstoquesRepository extends RepositoryInterface
{
    //
    function findcomWhere($where, $limite);
}
