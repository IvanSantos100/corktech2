@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de Classes</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.classes.create')}}">Nova classe</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th >Tamanho</th>
                            <th >Espessura</th>
                            <th >Atacado</th>
                            <th >Varejo</th>
                            <th >Granel</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $classe)
                            <tr>
                                <td class="col-md-3">{{ $classe->tamanho}}</td>
                                <td class="col-md-2">{{ $classe->espessura}}</td>
                                <td class="col-md-2">{{ $classe->atacado}}</td>
                                <td class="col-md-2">{{ $classe->varejo}}</td>
                                <td class="col-md-1">{{ $classe->granel}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.classes.edit', ['classe' => $classe->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.classes.show', ['classe' => $classe->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $classes->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection