<?php

namespace CorkTech\Models;

use CorkTech\Scopes\TenanModelItemProduto;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ItemPedido extends Model implements Transformable
{
    use TransformableTrait, TenanModelItemProduto;

    protected $table = 'itens_pedidos';

    protected $casts = [
        'preco' => 'float',
        'quantidade' => 'float'
    ];

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco',
        'prazoentrega',
        'lote',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function estoques()
    {
        return $this->belongsTo(Estoque::class, 'produto_id', 'produto_id');
    }

    public function getValorItemAttribute()
    {
        $itens = $this->pedido->valor_base == 0 ? 1 : $this->pedido->valor_base;

        return $this->produto->preco * $itens;
    }
}
