<?php

namespace CorkTech\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ItemPedido extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'itens_pedidos';

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco',
        'prazoentrega',
    ];

    public function pedido()
    {
        return $this->belongsTo('CorkTech\Models\Pedido', 'pedido_id', 'id');
    }

    public function produto()
    {
        return $this->belongsTo('CorkTech\Models\Produto', 'produto_id', 'id');
    }
}