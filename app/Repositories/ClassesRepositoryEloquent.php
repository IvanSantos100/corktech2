<?php

namespace CorkTeck\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTeck\Models\Classe;

/**
 * Class ClassesRepositoryEloquent
 * @package namespace CorkTeck\Repositories;
 */
class ClassesRepositoryEloquent extends BaseRepository implements ClassesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'tamanho' => 'like',
        'espessura' => 'like'
    ];

    public function model()
    {
        return Classe::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
