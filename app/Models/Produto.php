<?php

namespace CorkTech\Models;

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
        return $this->belongsTo('CorkTech\Models\Estampa', 'estampa_id', 'id');
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }

    public function tipoprodutos()
    {
        return $this->belongsTo(TipoProduto::class, 'tipoproduto_id', 'id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'itens_pedidos', 'produto_id', 'pedido_id');
    }

    public function centrodistribuicao()
    {
        return $this->belongsToMany(CentroDistribuicao::class, 'estoques', 'centrodistribuicao_id', 'centrodistribuicao_id')
            ->withPivot('lote', 'valor', 'quantidade','produto_id');
    }

    public function estoques()
    {
        return $this->belongsTo(Estoque::class, 'produto_id', 'id');
    }
}
