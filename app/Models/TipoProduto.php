<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoProduto extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'tipo_produtos';

    protected $fillable = [
        'descricao'
    ];

    public function produtos()
    {
        return $this->hasMany('CorkTeck\Models\Produto', 'estampa_id', 'id');
    }

}
