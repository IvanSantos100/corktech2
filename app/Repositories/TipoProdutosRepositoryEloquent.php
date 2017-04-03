<?php

namespace CorkTeck\Repositories;

use CorkTeck\Models\TipoProduto;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TipoProdutosRepositoryEloquent
 * @package namespace CorkTeck\Repositories;
 */
class TipoProdutosRepositoryEloquent extends BaseRepository implements TipoProdutosRepository
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
        return TipoProduto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
