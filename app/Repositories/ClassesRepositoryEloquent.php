<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Models\Classe;

/**
 * Class ClassesRepositoryEloquent
 * @package namespace CorkTech\Repositories;
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
        'espessura' => 'like',
        'descricao' => 'like'
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
