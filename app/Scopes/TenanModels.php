<?php

namespace CorkTech\Scopes;

use Illuminate\Database\Eloquent\Model;

trait TenanModels
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());

        static::creating(function(Model $model){

            $centrodistribuicao_id = \Auth::user()->centrodistribuicao_id;
            $model->desconto = $model->desconto ?? 0;

            if($centrodistribuicao_id == 1){
                if ($model->tipo == 1) {
                    $model->origem_id = null;
                    $model->destino_id = $centrodistribuicao_id;
                    $model->cliente_id = null;
                }
            }
            if ($model->tipo == 2) {
                $model->cliente_id = null;

                if ($centrodistribuicao_id != 1) {
                    $model->origem_id = 1;
                    $model->destino_id = $centrodistribuicao_id;
                }
            }

            if ($model->tipo == 3) {

                $model->destino_id = null;
                if ($centrodistribuicao_id != 1) {
                    $model->origem_id = $centrodistribuicao_id;
                }
            }
        });

        static::updating(function (Model $model){
           if ($model->status == 2){
               if($model->produtos->isEmpty()){
                   \Session::flash('error', 'Pedidos não tem produto cadastrado.');
                   return false;
               }
           }
        });
    }
}