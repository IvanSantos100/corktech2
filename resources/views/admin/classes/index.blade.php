@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3><a class="btn btn-primary" href="{{route('admim.classes.create')}}">Nova classe</a></h3>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Tamanho</th>
                    <th>Espessura</th>
                    <th>Atacado</th>
                    <th>Varejo</th>
                    <th>Granel</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classes as $classe)
                    <tr>
                        <td>{{ $classe->tamanho}}</td>
                        <td>{{ $classe->espessura}}</td>
                        <td>{{ $classe->atacado}}</td>
                        <td>{{ $classe->varejo}}</td>
                        <td>{{ $classe->granel}}</td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ route('admim.classes.edit', ['classe' => $classe->id]) }}">Editar</a></li>
                                <li>|</li>
                                <li>
                                    {!! Form::model(['route' => ['admim.classes.destroy', 'classe' => $classe->id], 'id' => $classe->id, 'method' => 'DELETE', 'style' => 'display:nome']).
                                    Form::close() !!}
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
@endsection