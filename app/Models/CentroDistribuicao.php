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
        'lote',
        'valor',
        'centrodistribuicao_id',
        'centrodistribuicao_id',
        'produto_id',
        'produto_id',
    ];

}
