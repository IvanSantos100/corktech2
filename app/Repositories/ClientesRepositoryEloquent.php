<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Models\Cliente;

/**
 * Class ProductRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class ClientesRepositoryEloquent extends BaseRepository implements ClientesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'tipo' => 'like',
        'nome' => 'like',
        'documento' => 'like',
        'responsavel' => 'like'
    ];

    public function model()
    {
        return Cliente::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
