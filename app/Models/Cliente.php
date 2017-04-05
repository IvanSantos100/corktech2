<?php

namespace CorkTech\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cliente extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'clientes';

    protected $fillable = [
        'tipo', //fisica ou jurídica
        'nome',
        'documento',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'senha',
        'responsavel',
        'fone',
        'celular',
    ];

    public function estampas()
    {
        return $this->belongsTo('CorkTech\Models\Estampa', 'estampa_id', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cliente_id', 'id');
    }

}
