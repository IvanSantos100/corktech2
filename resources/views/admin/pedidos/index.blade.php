@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de pedido</div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{route('admin.pedidos.create')}}">Novo Pedido</a>
                        <a class='btn btn-primary' href="{{route('admin.pedidosencerrados.index',['status' => 2])}}">Encerrados</a>
                    </div>
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Valor base</th>
                            <th>Desconto</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td class="col-md-1">{{ $pedido->id}}</td>
                                <td class="col-md-1">{{ $pedido->tipo_nome}}</td>
                                <td class="col-md-1">{{ $pedido->origem->descricao}}</td>
                                <td class="col-md-1">{{ $pedido->destino->descricao ?? "cliente - ".$pedido->cliente->nome}}</td>
                                <td class="col-md-2">R$ {{number_format($pedido->valor_base,2, ',', '.') }}</td>
                                <td class="col-md-1">{{ $pedido->desconto}} %</td>
                                <td class="col-md-4">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.itempedido.index', ['pedido' => $pedido->id]) }}">Produtos</a>
                                        </li>
                                        <li>
                                            @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-warning' href="{{ route('admin.pedidos.edit', ['pedido' => $pedido->id]) }}">Editar</a>
                                            @else
                                                <a class='btn btn-warning' disabled="true">Editar</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a class='btn btn-success' href="{{ route('admin.pedidos.status', ['pedido' => $pedido->id]) }}">Finalizar</a>
                                        </li>
                                        <li>
                                            @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-danger' href="{{ route('admin.pedidos.show', ['pedido' => $pedido->id]) }}">Excluir</a>
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
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection