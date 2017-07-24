<?php

namespace CorkTech\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

trait TenanModelEstoque
{
    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new TenantScope());



        static::creating(function (Model $model) {

            $quantidade = $model->whereLote($model->lote)
                ->whereValor($model->valor)
                ->whereProduto_id($model->produto_id)
                ->whereCentrodistribuicao_id($model->centrodistribuicao_id)->sum('quantidade')
            ;

            $model->quantidade = $quantidade + $model->quantidade;

        });

        static::updating(function (Model $model) {


        });

        static::updated(function (Model $model) {


        });
    }
}