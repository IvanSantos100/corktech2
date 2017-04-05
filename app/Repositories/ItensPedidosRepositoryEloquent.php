<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Repositories\ItensPedidosRepository;
use CorkTech\Models\ItemPedido;
use CorkTech\Validators\ItensPedidosValidator;

/**
 * Class ItensPedidosRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class ItensPedidosRepositoryEloquent extends BaseRepository implements ItensPedidosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ItemPedido::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
