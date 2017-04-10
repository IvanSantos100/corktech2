<?php

namespace CorkTech\Repositories;

use CorkTech\Models\Estoque;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EstoquesRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class EstoquesRepositoryEloquent extends BaseRepository implements EstoquesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'lote' => 'like',
        'centroDistribuicoes.descricao' => 'like',
        'produtos.descricao' => 'like'
    ];


    public function model()
    {
        return Estoque::class;
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
