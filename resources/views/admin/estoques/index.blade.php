@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de estoque</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.estoques.create')}}">Nova estoque</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Lote</th>
                            <th>Valor</th>
                            <th>Centro distribuição</th>
                            <th>Produto</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($estoques as $estoque)
                            <tr>
                                <td class="col-md-3">{{ $estoque->lote}}</td>
                                <td class="col-md-3">{{ $estoque->valor}}</td>
                                <td class="col-md-1">{{ $estoque->centrodistribuicao_id}}</td>
                                <td class="col-md-1">{{ $estoque->produto_id}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.estoques.edit', ['estoque' => $estoque->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.estoques.show', ['estoque' => $estoque->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $estoques->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection