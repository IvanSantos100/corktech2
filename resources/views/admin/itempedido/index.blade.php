@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{--<b>{{ $itens_pedido->id }}</b> tipo: <b>{{ $itens_pedido->tipo }}</b> destino: <b>{{ $itens_pedido->destino->descricao ?? $itens_pedido->cliente->nome }}</b>--}}</div>
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
                           href="{{route('admin.itempedido.produtos', ['pedidoId' => $pedidoId])}}">Adicionar
                            Produto</a>
                        <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    </div>
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Valor base</th>
                            <th>Lote</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itens_pedidos as $itens_pedido)
                            <tr>
                                <td class="col-md-1">{{ $itens_pedido->produto->id}}</td>
                                <td class="col-md-2">{{ $itens_pedido->produto->descricao}}</td>
                                <td class="col-md-2">{{ $itens_pedido->quantidade}}</td>
                                <td class="col-md-2">{{ $itens_pedido->preco}}</td>
                                <td class="col-md-1">{{ $itens_pedido->lote}}</td>
                                <td class="col-md-3">
                                    <ul class="list-inline">

                                        <li>
                                            @if ($itens_pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-warning' href="{{-- route('admin.pedido.edit',
                                                ['pedidoId' => $itens_pedido->pedido_id, 'produtoId' => $itens_pedido->produto_id])--}}">Editar</a>
                                            @else
                                                <a class='btn btn-warning' disabled="true">Editar</a>
                                            @endif
                                        </li>
                                        <li>
                                            <?php
                                                $form = "form-$itens_pedido->id";
                                            ?>
                                           <a class='btn btn-danger' href="#"
                                               onclick="event.preventDefault(); document.getElementById({{"\"$form\""}}).submit();">Excluir</a>

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
                    {{$itens_pedidos->links()}}
                    <div > <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Fachar pedido</a> </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection