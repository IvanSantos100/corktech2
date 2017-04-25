@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{ $itenspedido[0]->pivot->pedido_id}}</div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary"
                           href="{{route('admin.itenspedido.produtos', ['pedidoId' => $itenspedido[0]->pivot->pedido_id])}}">Novo
                            Produto</a>
                        <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    </div>
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Valor base</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itenspedido as $itempedido)

                            <tr>
                                <td class="col-md-2">{{ $itempedido->descricao}}</td>
                                <td class="col-md-2">{{ $itempedido->pivot->quantidade}}</td>
                                <td class="col-md-2">{{ $itempedido->pivot->preco}}</td>
                                <td class="col-md-3">
                                    <ul class="list-inline">
                                        <li>
                                            @if ($itempedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-warning' href="{{ route('admin.itenspedido.edit',
                                                ['pedidoId' => $itempedido->pivot->pedido_id, 'produtoId' => $itempedido->pivot->produto_id]) }}">Editar</a>
                                            @else
                                                <a class='btn btn-warning' disabled="true">Editar</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="#"
                                               onclick="event.preventDefault(); document.getElementById({{"\"form-{$itempedido->pivot->pedido_id}-{$itempedido->pivot->produto_id}\""}}).submit();">Excluir</a>

                                            {!! Form::open(['route' => ['admin.itenspedido.produto.delete',
                                                'pedidoId' => $itempedido->pivot->pedido_id, 'produtoId' => $itempedido->pivot->produto_id],
                                                'id' => "form-{$itempedido->pivot->pedido_id}-{$itempedido->pivot->produto_id}",
                                                'method' => 'DELETE', 'style' => 'display:nome']) !!}
                                            {!! Form::close() !!}
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$itenspedido->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection