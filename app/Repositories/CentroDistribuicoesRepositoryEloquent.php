<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Models\CentroDistribuicao;

/**
 * Class CentroDistribuicoesRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class CentroDistribuicoesRepositoryEloquent extends BaseRepository implements CentroDistribuicoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'descricao' => 'like',
        'tipo' => 'like'
    ];

    public function model()
    {
        return CentroDistribuicao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
