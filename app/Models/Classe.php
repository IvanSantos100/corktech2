<?php

namespace CorkTech\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Classe extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'classes';

    protected $fillable = [
        'descricao',
        'tamanho',
        'espessura',
        'atacado',
        'varejo',
        'granel',
    ];

    public function produtos()
    {
        return $this->hasMany('CorkTech\Models\Produto', 'estampa_id', 'id');
    }

}
