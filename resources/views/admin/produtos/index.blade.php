@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de produto</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.produtos.create')}}">Novo produto</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estampa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-3">{{ $produto->descricao}}</td>
                                <td class="col-md-3">{{ $produto->preco}}</td>
                                <td class="col-md-3">{{ $produto->estampas}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.produtos.edit', ['produto' => $produto->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.produtos.show', ['produto' => $produto->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection