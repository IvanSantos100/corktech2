@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr><th colspan="2">Dados do Pedido</th>
                            </tr></thead>
                            <tbody>
                                <tr>
                                    <td>Identificação: {{$pedido->id}}</td>
                                    <td>Tipo: {{$pedido->tipo_nome}}</td>
                                </tr>
                                <tr>
                                    <td>Origem: {{ $pedido->origem->descricao ?? 'Fabrica' }}</td>
                                    <td>Destino: {{ $pedido->destino->descricao ?? $pedido->cliente->nome }}</td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    @if($pedido->cliente!='')
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr><th colspan="3">Dados do Cliente</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tipo: @if($pedido->cliente->tipo==1) Física @else Jurídica @endif</td>
                                    <td>Documento: {{$pedido->cliente->documento_formatted}}</td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr><th colspan="3">Localização do Cliente</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td  colspan="2">Endereço: {{$pedido->cliente->endereco}}</td>
                                    <td>Bairro: {{$pedido->cliente->bairro}}</td>
                                </tr>
                                <tr>
                                    <td>Cidade: {{$pedido->cliente->cidade}}</td>
                                    <td>UF:{{$pedido->cliente->uf}}</td>
                                    <td>CEP:{{$pedido->cliente->cep}}</td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr><th colspan="2">Contatos do Cliente</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Telefone: {{$pedido->cliente->fone}}</td>
                                    <td>Celular: {{$pedido->cliente->celular}}</td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="pull-right hidden-print">
                        <a class='btn btn-primary pull-right' href="{{ route('admin.pedidosencerrados.index', ['status' => 2]) }}">Voltar</a>
                    </div>
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
                                            <a class='btn btn-primary' href="{{ route('admin.pedidosencerrados.details',
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