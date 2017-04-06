<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Repositories\ProdutosRepository;
use CorkTech\Models\Produto;
use CorkTech\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class ProdutosRepositoryEloquent extends BaseRepository implements ProdutosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'descricao' => 'like',
        'tipoprodutos.descricao' => 'like'
    ];


    public function model()
    {
        return Produto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
