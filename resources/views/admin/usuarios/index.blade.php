@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de usuários</div>
                <div class="panel-body">
                    <div class="pull-left hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    @if(checkPermission(['nacional']))
                        <div class="pull-right hidden-print">
                            <a class="btn btn-primary" href="{{route('admin.usuarios.create')}}">Novo usuário</a>
                        </div>
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Centro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td class="col-md-2">{{ $usuario->name}}</td>
                                <td class="col-md-2">{{ $usuario->email}}</td>
                                <td class="col-md-2">{{ $usuario->centroDistribuicoes->descricao}}</td>
                                @if(checkPermission(['nacional']))
                                    <td class="col-md-2  hidden-print">
                                        <ul class="list-inline">
                                            <li>
                                                <a class='btn btn-warning'
                                                   href="{{ route('admin.usuarios.edit', ['usuario' => $usuario->id]) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                            </li>
                                            <li>
                                                <a class='btn btn-danger'
                                                   href="{{ route('admin.usuarios.show', ['usuario' => $usuario->id]) }}"><span class="glyphicon glyphicon-trash"></span></a>
                                            </li>
                                        </ul>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="hidden-print">{{ $usuarios->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection