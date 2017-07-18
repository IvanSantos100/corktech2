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
        'id' => 'like',
        'produto.descricao' => 'like'
    ];

    public function model()
    {
        return ItemPedido::class;
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

    public function delItemLote($perido_id, $produto_id, $lote)
    {
        if($lote !== 'null') {
            return $this->model->where(['pedido_id' => $perido_id, 'produto_id' => $produto_id, 'lote' => $lote])->delete();
        }
        return $this->model->where(['pedido_id' => $perido_id, 'produto_id' => $produto_id])->delete();
    }
}
