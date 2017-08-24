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
        'codigo' => '=',
        'descricao' => 'like',
        'estoques.lote' => '=',
        'tipoprodutos.descricao' => 'like',
        'estampas.descricao' => 'like',
        'classes.descricao' => 'like',
        'tipoproduto_id'
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
