<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Estoque extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'estoques';

    protected $fillable = [
        'descricao',
        'tipo',
        'prazo_fabrica',
        'prazo_nacional',
        'prazo_regional',
        'valor_base'
    ];

}
