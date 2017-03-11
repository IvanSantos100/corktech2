<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Estampa extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'estampas';

    protected $fillable = [
        'descricao'
    ];

    public function produtos()
    {
        return $this->hasMany('CorkTeck\Models\Produto', 'estampa_id', 'id');
    }

}
