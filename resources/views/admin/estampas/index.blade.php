@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de Estampa</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.estampas.create')}}">Nova estampa</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th >Descrição</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($estampas as $estampa)
                            <tr>
                                <td class="col-md-3">{{ $estampa->descricao}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.estampas.edit', ['estampa' => $estampa->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.estampas.show', ['estampa' => $estampa->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $estampas->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection