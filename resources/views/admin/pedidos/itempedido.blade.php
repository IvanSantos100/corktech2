@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{ $itenspedido[0]->pedido_id}}</div>
                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Lote</th>
                            <th>Descrição</th>
                            <th>Classe</th>
                            <th>Tamanho</th>
                            <th>Quantidade</th>
                            <th>Valor base</th>
                            <th>Valor item</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itenspedido as $itempedido)
                            <tr>
                                <td class="col-md-1">{{ $itempedido->produto->codigo}}</td>
                                <td class="col-md-1">{{ $itempedido->lote}}</td>
                                <td class="col-md-2">{{ $itempedido->produto->descricao}}</td>
                                 <td class="col-md-1">
                                    {{$itempedido->produto->classes->descricao}}
                                    @if(!empty($itempedido))
                                        @if(file_exists("images/thumbnail/estampa-{$itempedido->produto->estampas->id}.png"))
                                            {{ HTML::image("/images/thumbnail/estampa-{$itempedido->produto->estampas->id}.png") }}
                                        @endif
                                    @endif
                                </td>
                                <td class="col-md-1">{{ $itempedido->produto->classes->tamanho}}</td>
                                <td class="col-md-1">{{ $itempedido->quantidade}}</td>
                                <td class="col-md-1">
                                    R$ {{ number_format($itempedido->preco,2, ',', '.') }}
                                </td>
                                <td class="col-md-2">
                                    R$ {{ number_format($itempedido->valor_item,2, ',', '.') }}
                                </td>
                                <td class="col-md-2">
                                    R$ {{ number_format(($itempedido->quantidade * $itempedido->valor_item),2, ',', '.') }}
                                </td>
                                <td class="col-md-1 hidden-print">
                                    <ul class="list-inline">
                                       <li>
                                            <a class='btn btn-primary' href="{{ route('admin.itempedido.details',
                                            ['status'=> 2, 'pedidoId' => $itempedido->pedido_id, 'produtoId' => $itempedido->produto_id]) }}"><span class='glyphicon glyphicon-list-alt'></span></a>

                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        <table>
                            <tr>
                                <td class="col-md-2"><b>TOTAL:</b></td>
                                <td><b>R$ {{number_format(($itenspedido[0]->pedido->valor_total),2, ',', '.') }}</b></td>
                            </tr>
                            <tr>
                                <td class="col-md-2"><b>DESCONTO:</b></td>
                                <td><b>{{number_format(($itenspedido[0]->pedido->desconto),2, ',', '.') }} %</b></td>
                            </tr>
                            <tr>
                                <td class="col-md-2"><b>VALOR FINAL:</b></td>
                                <td><b>R$ {{number_format($itenspedido[0]->pedido->valor_final, 2, ',', '.') }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="hidden-print">{{ $itenspedido->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection