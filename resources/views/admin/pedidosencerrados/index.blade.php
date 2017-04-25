@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de pedido</div>
                <div class="panel-body">
                    <div>
                        <div class="btn-group pull-right">
                            <a class='btn btn-primary' href="{{route('admin.pedidos.index')}}">Andamento</a>
                        </div>
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
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>Valor base</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td class="col-md-3">{{ $pedido->id}}</td>
                                <td class="col-md-3">{{ $pedido->tipo}}</td>
                                <td class="col-md-3">{{ $pedido->status}}</td>
                                <td class="col-md-3">R$ {{number_format($pedido->valor_base,2, ',', '.') }}</td>
                                <td class="col-md-1">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.pedidosencerrados.itenspedido', ['pedido' => $pedido->id]) }}">Produtos</a>
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