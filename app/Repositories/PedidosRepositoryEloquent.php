<?php

namespace CorkTech\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CorkTech\Models\Pedido;

/**
 * Class PedidosRepositoryEloquent
 * @package namespace CorkTech\Repositories;
 */
class PedidosRepositoryEloquent extends BaseRepository implements PedidosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $fieldSearchable = [
        'id' => 'like',
        'tipo' => 'like',
    ];


    public function model()
    {
        return Pedido::class;
    }

    public function updateValorPedido($pedidoId)
    {
        $valorPedido = $this->model->find($pedidoId)->produtos->sum(function ($produtos) {
            return $produtos->pivot->preco * $produtos->pivot->quantidade;
        });

        $this->model->updateOrCreate(['id'=>$pedidoId],['valor_base'=>$valorPedido]);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function findWherePaginate($where, $limit){
        $this->applyCriteria();
        $this->applyScope();
        $this->applyConditions($where);
        $model = $this->model->paginate($limit);
        $this->resetModel();
        return $this->parserResult($model);
    }



    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
