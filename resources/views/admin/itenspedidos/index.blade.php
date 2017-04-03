@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de item pedido</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.itenspedidos.create')}}">Novo itenspedido</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id do pedido</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Prazo de entrega</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itenspedidos as $itenspedido)
                            <tr>
                                <td class="col-md-2">{{ $itenspedido->pedido->id}}</td>
                                <td class="col-md-2">{{ $itenspedido->produto->descricao}}</td>
                                <td class="col-md-2">{{ $itenspedido->quantidade}}</td>
                                <td class="col-md-2">{{ $itenspedido->preco}}</td>
                                <td class="col-md-2">{{ $itenspedido->prazoentrega}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.itenspedidos.edit', ['itenspedido' => $itenspedido->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.itenspedidos.show', ['itenspedido' => $itenspedido->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $itenspedidos->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection