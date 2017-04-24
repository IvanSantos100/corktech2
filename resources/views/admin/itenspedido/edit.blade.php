@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar produto do pedido: {{ $pedidoId }}</div>
                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Estampa</th>
                            <th>Tipo produto</th>
                            <th>Classe</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-2">{{ $produto->descricao}}</td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">{{ $produto->tipoprodutos->descricao}}</td>
                                <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                                <td class="col-md-2">R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                                <td class="col-md-1">
                                    {!! Form::open(['route' => ['admin.itenspedido.update', $pedidoId, $produto->id],
                                      'class' => 'form', 'id' => "add-form-{$pedidoId}-{$produto->id}", 'method' => 'PUT']) !!}

                                        {!! form::number('quantidade', $produto->pivot->quantidade, ['min' => 1]) !!}

                                    {!! Form::close() !!}
                                </td>
                                <td class="col-md-1">
                                    <a class='btn btn-success' href="#"
                                       onclick="document.getElementById({{"\"add-form-{$pedidoId}-{$produto->id}\""}}).submit();">Add
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection