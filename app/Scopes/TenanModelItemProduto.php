<?php

namespace CorkTech\Scopes;

use Illuminate\Database\Eloquent\Model;

trait TenanModelItemProduto
{
    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new TenantScope());


        static::creating(function(Model $model){


        });

    }
}