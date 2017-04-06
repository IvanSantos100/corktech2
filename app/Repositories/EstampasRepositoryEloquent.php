<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Repositories\EstampasRepository;
use CorkTech\Models\Estampa;
use CorkTech\Validators\EstampasValidator;

/**
 * Class EstampasRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class EstampasRepositoryEloquent extends BaseRepository implements EstampasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'descricao' => 'like'
    ];

    public function model()
    {
        return Estampa::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
