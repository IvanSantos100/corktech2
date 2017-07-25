<?php

namespace CorkTech\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

trait TenanModelPedido
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $model) {

            $centrodistribuicao_id = \Auth::user()->centrodistribuicao_id;
            $model->desconto = $model->desconto ?? 0;

            if ($centrodistribuicao_id == 1) {
                if ($model->tipo == 1) {
                    $model->origem_id = null;
                    $model->destino_id = $centrodistribuicao_id;
                    $model->cliente_id = null;
                }
            }
            if ($model->tipo == 2) {
                $model->cliente_id = null;

                if ($centrodistribuicao_id != 1) {
                    $model->origem_id = 1;
                    $model->destino_id = $centrodistribuicao_id;
                }
            }
            if ($model->tipo == 3) {

                $model->destino_id = null;
                if ($centrodistribuicao_id != 1) {
                    $model->origem_id = $centrodistribuicao_id;
                }
            }
        });

        static::updating(function (Model $model) {

            if ($model->status == 2) {
                if ($model->produtos->isEmpty()) {
                    \Session::flash('error', 'Pedidos não tem produto cadastrado.');
                    return false;
                }

                if ($model->tipo != 1) {
                    //verifica produto disponivel do estoque
                    $estoqueMenor = [];
                    $itensPedido = $model->produtos;
                    foreach ($itensPedido as $itemPedido) {
                        if ($itemPedido->lote) {
                            $estoqueQnt = $itemPedido->estoques->whereLote($itemPedido->lote)->whereCentrodistribuicao_id($model->origem_id)->first()->quantidade;

                            if ($itemPedido->quantidade > $estoqueQnt) {
                                $estoqueMenor[] = true;
                            }
                        }
                    }

                    if (!empty($estoqueMenor)) {
                        \Session::flash('error', 'Há produto indisponível no estoque.');
                        return false;
                    }
                }
            }

            $model->date_confirmacao = Carbon::now();

        });

        static::updated(function (Model $model) {

            if ($model->status == 2) {
                $itensPedido = $model->produtos;

                foreach ($itensPedido as $itemPedido) { //dd($model, $itemPedido);    updateOrCreate

                    if ($itemPedido->lote) {
                        $estoqueQnt = $itemPedido->estoques->whereLote($itemPedido->lote)->whereCentrodistribuicao_id($model->origem_id)->first()->quantidade;

                        //deleta estoque origem
                        if ($itemPedido->quantidade = $estoqueQnt) {
                            $itemPedido->estoques->whereLote($itemPedido->lote)->whereCentrodistribuicao_id($model->origem_id)->first()->delete();
                        }
                        //update estoque origem
                        if ($itemPedido->quantidade < $estoqueQnt) {
                            $qnt = $estoqueQnt - $itemPedido->quantidade;
                            $itemPedido->estoques->whereLote($itemPedido->lote)->whereCentrodistribuicao_id($model->origem_id)->first()->update(['quantidade', $qnt]);
                        }
                    }

                    //incrementa estoque destino
                    $estoqueOrigem = $itemPedido->estoques()->where(
                        ['lote' => $itemPedido->lote ?? $itemPedido->pedido_id,
                            'centrodistribuicao_id' => $model->destino_id,
                            'produto_id' => $itemPedido->produto_id,
                            'valor' => $itemPedido->preco,
                            'quantidade' => $itemPedido->quantidade
                        ]
                    )->get();

                    if($estoqueOrigem->isEmpty()) {

                        $itemPedido->estoques()->create(
                            ['lote' => $itemPedido->lote ?? $itemPedido->pedido_id,
                                'centrodistribuicao_id' => $model->destino_id,
                                'produto_id' => $itemPedido->produto_id,
                                'valor' => $itemPedido->preco,
                                'quantidade' => $itemPedido->quantidade
                            ]
                        );
                    }else{
                        $itemPedido->estoques()->update(
                            ['lote' => $itemPedido->lote ?? $itemPedido->pedido_id,
                                'centrodistribuicao_id' => $model->destino_id,
                                'produto_id' => $itemPedido->produto_id,
                                'valor' => $itemPedido->preco,
                                'quantidade' => $itemPedido->quantidade
                            ]
                        );

                    }

                }
                \Session::flash('message', "Pedido {$model->id} finalizado com sucesso.");
            }
        });
    }
}