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
    ];

    public function origens()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'origem_id', 'id');
    }

    public function destinos()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'destino_id', 'id');
    }

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'itens_pedidos', 'produto_id', 'pedido_id');
    }

}
