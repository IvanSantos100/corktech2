<?php

namespace CorkTech\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CentroDistribuicao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'centro_distribuicoes';

    const TIPO = [
        1 => 'Nacional',
        2 => 'Distribuidora',
        3 => 'Revenda'];

    protected $fillable = [
        'descricao',
        'tipo',
        'prazo_fabrica',
        'prazo_nacional',
        'prazo_regional',
        'valor_base',
    ];

    public function getTipoNomeAttribute()
    {
        return array_values(CentroDistribuicao::TIPO)[$this->tipo -1];
    }

    public function produtos()
    {
        //return $this->hasMany('CorkTech\Models\Produto', 'estampa_id', 'id');
        return $this->belongsToMany(Produto::class, 'estoques', 'centrodistribuicao_id', 'produto_id')
            ->withPivot('lote', 'valor', 'quantidade');
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
