<?php

namespace CorkTech\Models;

use CorkTech\Scopes\TenanModelPedido;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pedido extends Model implements Transformable
{
    use TransformableTrait, TenanModelPedido;

    protected $table = 'pedidos';

    protected $dates = ['date_confirmacao'];

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

    public function getValorTotalAttribute()
    {
        $itens = $this->produtos()->pluck('quantidade', 'preco');
        $total = 0;
        foreach ($itens as $item => $key) {
            $total += $item * $key;
        }

        $valor_base = $this->destino_id ? $this->destino->valor_base : 1;

        return $total * $valor_base;
    }
}

