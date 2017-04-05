@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar usuário</div>
                <div class="panel-body">
                    {!! Form::model($usuario,[
                    'route' => ['admin.usuarios.update' , 'class' => $usuario->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.usuarios._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar usuário', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection