<?php

namespace CorkTeck\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Produto extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'produtos';

    protected $fillable = [
        'descricao',
        'preco',
        'estampa_id',
        'classe_id',
        'tipoproduto_id',
    ];

    public function estampas()
    {
        return $this->belongsTo('CorkTeck\Models\Estampa');
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class);
    }

    public function tipoprodutos()
    {
        return $this->belongsTo(TipoProduto::class);
    }

}
