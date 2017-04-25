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
        $this->applyConditionsOr($where);
        $model = $this->model->paginate($limit);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function findOrWherePaginate($where, $limit){
        $this->applyCriteria();
        $this->applyScope();
        $this->applyConditionsOr($where);
        $model = $this->model->paginate($limit);
        $this->resetModel();
        return $this->parserResult($model);
    }


    protected function applyConditionsOr(array $where)
    {
        $cont = 0;
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                if($cont==0){
                    $this->model = $this->model->where($field, $condition, $val);
                    $cont++;
                }else {
                    $this->model = $this->model->orWhere($field, $condition, $val);
                }
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
