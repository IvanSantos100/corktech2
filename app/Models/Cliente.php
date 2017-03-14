<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cliente extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'clientes';

    protected $fillable = [
        'tipo', //fisica ou jurídica
        'Nome',
        'documento',
        'endereco',
        'bairro',
        'cidade',
        'UF',
        'CEP',
        'senha',
        'responsável',
        'fone',
        'celular',
    ];

    public function estampas()
    {
        return $this->belongsTo('CorkTeck\Models\Estampa', 'estampa_id', 'id');
    }

}
