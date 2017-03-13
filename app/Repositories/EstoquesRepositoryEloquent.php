<?php

namespace CorkTeck\Repositories;

use CorkTeck\Models\Estoque;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EstoquesRepositoryEloquent
 * @package namespace CorkTeck\Repositories;
 */
class EstoquesRepositoryEloquent extends BaseRepository implements EstoquesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Estoque::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
