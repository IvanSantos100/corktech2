@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Itens do pedido:
                    <b>{{$pedido->id}} </b>
                    tipo:
                    <b>{{ $pedido->tipo_nome }}</b>
                    Origem:
                    <b>{{ $pedido->origem->descricao ?? 'Fabrica' }}</b>
                    destino:
                    <b>{{ $pedido->destino->descricao ?? $pedido->cliente->nome }}</b>
                </div>
                <div class="panel-body">
                    <div class="pull-left hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right hidden-print">
                        <a class="btn btn-primary"
                           href="{{route('admin.itempedido.produtos', ['pedidoId' => $pedidoId])}}">Adicionar
                            Produto</a>

                        @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                            <a class='btn btn-warning'
                               href="{{ route('admin.pedidos.edit', ['pedido' => $pedido->id]) }}">Editar</a>
                        @else
                            <a class='btn btn-warning' disabled="true">Editar</a>
                        @endif

                        <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    </div>
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Lote</th>
                            <th>Descrição</th>
                            <th>Tamanho</th>
                            <th>Quantidade</th>
                            <th>Valor base</th>
                            <th>Valor item</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0
                        @endphp
                        @foreach($itens_pedidos as $itens_pedido)
                            <tr>
                                <td class="col-md-1">{{ $itens_pedido->produto->codigo}}</td>
                                <td class="col-md-1">{{ $itens_pedido->lote}}</td>
                                <td class="col-md-2">{{ $itens_pedido->produto->descricao}}</td>
                                <td class="col-md-1">{{ $itens_pedido->produto->classes->tamanho}}</td>
                                <td class="col-md-1">{{ $itens_pedido->quantidade}}</td>
                                <td class="col-md-1">
                                    R$ {{ number_format($itens_pedido->produto->preco,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">
                                    R$ {{ number_format($itens_pedido->valor_item,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">
                                    R$ {{ number_format(($itens_pedido->quantidade * $itens_pedido->valor_item),2, ',', '.') }}
                                </td>
                                <td class="col-md-2 hidden-print">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.itempedido.details',
                                            ['pedidoId' => $itens_pedido->pedido_id, 'produtoId' => $itens_pedido->produto_id]) }}"><span
                                                        class='glyphicon glyphicon-list-alt'></span></a>
                                        </li>
                                        <li>
                                            <?php
                                            $form = "form-$itens_pedido->id";
                                            ?>
                                            <a class='btn btn-danger' href="#"
                                               onclick="event.preventDefault(); document.getElementById({{"\"$form\""}}).submit();"><span
                                                        class='glyphicon glyphicon-trash'></span></a>

                                            {!! Form::open(['route' => ['admin.itempedido.produto.delete',
                                                'pedidoId' => $pedidoId,'itempedido' => $itens_pedido->id],
                                                'id' => "$form",
                                                'method' => 'DELETE', 'style' => 'display:nome']) !!}
                                            {!! Form::close() !!}
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
                                <td><b>R$ {{number_format(($pedido->valor_total),2, ',', '.') }}</b></td>
                            </tr>
                            <tr>
                                <td class="col-md-2"><b>DESCONTO:</b></td>
                                <td><b>{{number_format(($pedido->desconto),2, ',', '.') }} %</b></td>
                            </tr>
                            <tr>
                                <td class="col-md-2"><b>VALOR FINAL:</b></td>
                                <td><b>R$ {{number_format($pedido->valor_final, 2, ',', '.') }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="hidden-print">{{ $itens_pedidos->links() }}</div>
                </div>
                <div class="panel-footer hidden-print text-center">
                    <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Salvar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
