<?php

namespace CorkTeck\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTeck\Models\CentroDistribuicao;

/**
 * Class CentroDistribuicoesRepositoryEloquent
 * @package namespace CorkTeck\Repositories;
 */
class CentroDistribuicoesRepositoryEloquent extends BaseRepository implements CentroDistribuicoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
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
