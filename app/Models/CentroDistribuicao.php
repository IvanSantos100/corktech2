<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CentroDistribuicao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'centro_distribuicoes';

    protected $fillable = [
        'descricao',
        'tipo',
        'prazo_fabrica',
        'prazo_nacional',
        'prazo_regional',
        'valor_base'
    ];

}
