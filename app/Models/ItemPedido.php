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
        'lote'
    ];

    public function pedido()
    {
        return $this->belongsTo('CorkTech\Models\Pedido', 'pedido_id', 'id');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class,'id', 'produto_id');
    }
}
