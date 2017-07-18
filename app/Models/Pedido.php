<?php

namespace CorkTech\Models;

use CorkTech\Scopes\TenanModels;
use CorkTech\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pedido extends Model implements Transformable
{
    use TransformableTrait, TenanModels;

    protected $table = 'pedidos';

    //Nacional
    const TIPO = [
        1 => 'Entrada',
        2 => 'Movimentação',
        3 => 'Saída'];

    //Distribuidora e Revenda
    const TIPO_2 = [
        2 => 'Movimentação',
        3 => 'Saída'];

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

    public function getTipoNomeAttribute()
    {
        return array_values(Pedido::TIPO)[$this->tipo -1];
    }

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
        return $this->hasMany(ItemPedido::class);
    }
}

