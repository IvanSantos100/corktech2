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
        'centrodistribuicao_id',
    ];

    protected $hidden = [
        'senha'
    ];

    public function estampas()
    {
        return $this->belongsTo('CorkTech\Models\Estampa', 'estampa_id', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cliente_id', 'id');
    }

    public function centroDistribuicoes()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'centrodistribuicao_id', 'id');
    }

    public function getDocumentoFormattedAttribute()
    {
        $string = $this->documento;
        if (!empty($string)) {
            if (strlen($string) == 11) {
                $string = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $string);
            } else {
                $string = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3.$4-$5', $string);
            }
        }
        return $string;
    }

}
