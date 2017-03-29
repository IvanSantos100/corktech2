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
        'valor_base',
    ];

    public function produtos()
    {
        return $this->hasMany('CorkTeck\Models\Produto', 'estampa_id', 'id');
    }

    public function origens()
    {
        return $this->hasMany(Pedido::class, 'origem_id', 'id');
    }

    public function destinos()
    {
        return $this->hasMany(Pedido::class, 'destino_id', 'id');
    }

}
