@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do pedido: {{ $itenspedido[0]->pedido_id}}</div>
                <div class="panel-body">
                    <div class="pull-right">
                        <a class='btn btn-primary pull-right' href="{{ route('admin.pedidosencerrados.index', ['status' => 2]) }}">Voltar</a>
                    </div>
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
                        @foreach($itenspedido as $itempedido)

                            <tr>
                                <td class="col-md-1">{{ $itempedido->produto->codigo}}</td>
                                <td class="col-md-3">{{ $itempedido->produto->descricao}}</td>
                                <td class="col-md-3">{{ $itempedido->quantidade}}</td>
                                <td class="col-md-3">R$ {{ number_format($itempedido->preco,2, ',', '.')}}</td>
                                <td class="col-md-3">{{ $itempedido->lote}}</td>
                                <td class="col-md-1">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.pedidosencerrados.details',
                                            ['status'=> 2, 'pedidoId' => $itempedido->pedido_id, 'produtoId' => $itempedido->produto_id]) }}">Detalhar</a>

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