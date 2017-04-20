@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{ $itenspedido[0]->pedido_id}}</div>
                <div class="panel-body">
                    <div>
                        <a class="btn btn-primary" href="{{route('admin.itenspedido.produtos', ['pedidoId' => $itenspedido[0]->pedido_id])}}">Novo Produto</a>
                    </div>
                    <br>
                    <div>
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
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
                                <td class="col-md-2">{{ $itempedido->produto->descricao}}</td>
                                <td class="col-md-2">{{ $itempedido->quantidade}}</td>
                                <td class="col-md-2">{{ $itempedido->preco}}</td>
                                <td class="col-md-3">
                                    <ul class="list-inline">
                                        <li>
                                            @if ($itempedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-warning' href="{{ route('admin.itenspedido.produto.edit',
                                                ['pedidoId' => $itempedido->pedido_id, 'produtoId' => $itempedido->produto_id]) }}">Editar</a>
                                            @else
                                                <a class='btn btn-warning' disabled="true">Editar</a>
                                            @endif
                                        </li>
                                        <li>
                                            @if ($itempedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-danger' href="{{ route('admin.pedidos.show', ['pedido' => $itempedido->produto_id]) }}">Excluir</a>
                                            @else
                                                <a class='btn btn-danger' disabled="true">Excluir</a>
                                            @endif

                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection