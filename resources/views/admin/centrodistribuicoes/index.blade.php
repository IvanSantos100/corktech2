@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de centro de distribuicão</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.centrodistribuicoes.create')}}">Nova centro de distribuicão</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Tipo</th>
                            <th>Prazo fabrica</th>
                            <th>Prazo nacional</th>
                            <th>Prazo regional</th>
                            <th>Valor base</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($centrodistribuicoes as $centrodistribuicao)
                            <tr>
                                <td class="col-md-3">{{ $centrodistribuicao->descricao}}</td>
                                <td class="col-md-3">{{ $centrodistribuicao->tipo}}</td>
                                <td class="col-md-1">{{ $centrodistribuicao->prazo_fabrica}}</td>
                                <td class="col-md-1">{{ $centrodistribuicao->prazo_nacional}}</td>
                                <td class="col-md-1">{{ $centrodistribuicao->prazo_regional}}</td>
                                <td class="col-md-1">{{ $centrodistribuicao->valor_base}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.centrodistribuicoes.edit', ['centrodistribuicao' => $centrodistribuicao->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.centrodistribuicoes.show', ['centrodistribuicao' => $centrodistribuicao->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $centrodistribuicoes->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection