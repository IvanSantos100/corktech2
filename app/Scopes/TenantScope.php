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
        if ($centrodistribuicao != 1) {
            $builder->where('origem_id', $centrodistribuicao)
                ->where('status', 1)
                ->orWhere(['destino_id' => $centrodistribuicao]);
        }else{
            $builder->where('status', 1);
        }

    }
}