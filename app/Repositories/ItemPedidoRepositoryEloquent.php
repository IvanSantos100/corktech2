<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Repositories\ItemPedidoRepository;
use CorkTech\Models\ItemPedido;
use CorkTech\Validators\itempedidosValidator;

/**
 * Class itempedidosRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class ItemPedidoRepositoryEloquent extends BaseRepository implements ItemPedidoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'lote' => '=',
        'produto.descricao' => 'like'
    ];

    public function model()
    {
        return ItemPedido::class;
    }


    public function findWherePaginate($where, $limit)
    {
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
