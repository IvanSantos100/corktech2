<?php

namespace CorkTech\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pedido extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'pedidos';

    protected $fillable = [
        'tipo',
        'status',
        'valor_base',
        'desconto',
        'forma_pagamento',
        'obs',
        'date_confimacao',
        'cliente_id',
        'origem_id',
        'destino_id'
    ];

    public function origem()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'origem_id', 'id');
    }

    public function destino()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'destino_id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'itens_pedidos', 'pedido_id', 'produto_id')
            ->withPivot('quantidade', 'preco', 'prazoentrega');
    }
}
///$p->produto(10)->attach(1,['quantidade'=>100,'preco'=>123, 'prazoentrega'=>'1']);
