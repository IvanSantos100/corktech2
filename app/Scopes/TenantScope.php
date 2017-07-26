<?php

namespace CorkTech\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        $centrodistribuicao = \Auth::user()->centrodistribuicao_id;

        $status = 1;
        $destino = 'destino_id';

        //dd(\Route::current()->parameterNames);

        if(\Route::get('pedidosencerrados')->uri() === 'pedidosencerrados'){
            $status = 2;
            $destino = 'origem_id';
        }

        if ($centrodistribuicao != 1) {
            $builder->where('status', $status)
                ->where(function ($query) use ($centrodistribuicao, $destino) {
                    $query->where('origem_id', $centrodistribuicao)
                        ->orWhere($destino, $centrodistribuicao);
                });
        } else {
            $builder->where('status', $status);
        }
    }
}