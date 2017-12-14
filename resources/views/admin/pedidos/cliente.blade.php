@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                @if($total_rows>0)
                    <div class="panel-heading">Cliente: {{$pedidos[0]->cliente->nome}}</div>
                    <div class="panel-body">
                        <div class="pull-left hidden-print">
                            {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                            {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                            {!! Form::text('search', null, ['class' => 'form-control']) !!}
                            {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                            {!! Form::close()!!}
                        </div>
                        <br><br>
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>Origem</th>
                                <th>Status</th>
                                <th>Valor base</th>
                                <th>Desconto</th>
                                <th>Total</th>
                                <th>Valor Final</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td class="col-md-1">{{ $pedido->id}}</td>
                                    <td class="col-md-1">{{ $pedido->tipo_nome}}</td>
                                    <td class="col-md-2">{{ $pedido->origem->descricao ?? 'Fabrica'}}</td>
                                    @if($pedido->status==1)
                                        <td class="col-md-1">Aberto</td>
                                    @else
                                        <td class="col-md-1">Fechado</td>
                                    @endif
                                    <td class="col-md-1">{{ $pedido->valor_base }} %</td>
                                    <td class="col-md-1">{{ $pedido->desconto}} %</td>
                                    <td class="col-md-1">R$ {{number_format(($pedido->valor_total),2, ',', '.') }}</td>
                                    <td class="col-md-1">R$ {{number_format(($pedido->valor_final),2, ',', '.') }}</td>
                                    <td class="col-md-2 hidden-print">
                                        <ul class="list-inline">
                                            <li>
                                                <a class='btn btn-primary'
                                                href="{{ route('admin.pedidos.itempedido', ['pedido' => $pedido->id]) }}"><span
                                                            class='glyphicon glyphicon-list-alt'></span></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="hidden-print">{{ $pedidos->links() }}</div>
                    </div>
                @else
                 <div class="panel-body">
                    Cliente não possui pedidos
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

