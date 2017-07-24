<?php

namespace CorkTech\Scopes;

use Illuminate\Database\Eloquent\Model;

trait TenanModelItemProduto
{
    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new TenantScope());


        static::creating(function (Model $model) {

            if ($model->pedido->tipo == 1) {
                $model->prazoentrega = $model->pedido->destino->prazo_fabrica;
                $model->preco = $model->produto->preco;
                return true;
            }

            $model->preco = $model->estoques->where('centrodistribuicao_id', $model->pedido->origem->id)
                ->where('produto_id', $model->produto_id)
                ->where('lote', $model->lote)->first()->valor;

            if ($model->pedido->tipo == 2) {
                $model->prazoentrega = $model->pedido->origem->prazo_nacional;
            }

            if ($model->pedido->tipo == 3) {
                $model->prazoentrega = $model->pedido->origem->prazo_regional;
            }

        });

        static::created(function (Model $model) {
            $produtos = $model->pedido->produtos;
            $sum = 0;
            foreach ($produtos as $produto) {
                $sum += $produto->quantidade * $produto->preco;
            }

            $model->pedido->update(['valor_base' => $sum]);

        });

        static::deleted(function (Model $model) {

            $produtos = $model->pedido->produtos;
            $sum = 0;
            foreach ($produtos as $produto) {
                $sum += $produto->quantidade * $produto->preco;
            }

            $model->pedido->update(['valor_base' => $sum]);

        });


        /*      "pedido_id" => "21"
                "produto_id" => "80"
                "quantidade" => "1"
                "preco" => 1
                "prazoentrega" => "2017-07-07"
        */

    }
}