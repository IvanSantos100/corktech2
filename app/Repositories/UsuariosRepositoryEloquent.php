<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Models\User;

/**
 * Class UsuariosRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class UsuariosRepositoryEloquent extends BaseRepository implements UsuariosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'email' => 'like'
    ];


    public function model()
    {
        return User::class;
    }

    public function findWherePaginate($where, $limit){
        $this->applyCriteria();
        $this->applyScope();
        $this->applyConditions($where);
        $model = $this->model->paginate($limit);
        $this->resetModel();
        return $this->parserResult($model);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
