<?php

namespace CorkTeck\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTeck\Repositories\ItensPedidosRepository;
use CorkTeck\Models\ItemPedido;
use CorkTeck\Validators\ItensPedidosValidator;

/**
 * Class ItensPedidosRepositoryEloquent
 * @package namespace CorkTeck\Repositories;
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
