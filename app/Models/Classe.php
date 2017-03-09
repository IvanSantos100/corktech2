<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Classe extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'classes';

    protected $fillable = [
        'tamanho',
        'espessura',
        'atacado',
        'varejo',
        'granel',
    ];

}
