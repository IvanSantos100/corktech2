@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar usuário
                </div>
                {!! Form::model($usuario,[
                   'route' => ['admin.usuarios.update' , 'class' => $usuario->id],
                   'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    <div class="pull-right">
                        <a class='btn btn-warning' href="{{ route('admin.usuarios.editpassword', ['usuario' => $usuario->id]) }}">Alterar Senha</a>
                    </div><br>
                    @include('admin.usuarios._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar usuário', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection