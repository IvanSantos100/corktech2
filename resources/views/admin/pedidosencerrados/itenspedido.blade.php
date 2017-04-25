@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{ $itenspedido[0]->pivot->pedido_id}}</div>
                <div class="panel-body">
                    <div>
                        <a class='btn btn-primary pull-right' href="{{ route('admin.pedidosencerrados.index') }}">Voltar</a>
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
                                <td class="col-md-3">{{ $itempedido->descricao}}</td>
                                <td class="col-md-3">{{ $itempedido->pivot->quantidade}}</td>
                                <td class="col-md-3">{{ $itempedido->pivot->preco}}</td>
                                <td class="col-md-1">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.pedidosencerrados.details',
                                            ['pedidoId' => $itempedido->pivot->pedido_id, 'produtoId' => $itempedido->pivot->produto_id]) }}">Detalhar</a>

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