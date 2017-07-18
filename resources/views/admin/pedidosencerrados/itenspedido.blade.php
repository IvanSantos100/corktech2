@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{ $itempedido[0]->pivot->pedido_id}}</div>
                <div class="panel-body">
                    <div class="pull-right">
                        <a class='btn btn-primary pull-right' href="{{ route('admin.pedidosencerrados.index') }}">Voltar</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Valor base</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itempedido as $itempedido)

                            <tr>
                                <td class="col-md-1">{{ $itempedido->codigo}}</td>
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
                    {{$itempedido->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection