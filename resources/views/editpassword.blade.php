@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Editar usuário</div>
            {!! Form::model($usuario,['route' => ['updatepassword'],'class' => 'form', 'method' => 'PUT']) !!}
            <div class="panel-body">
                {!! Form::hidden('redirect_to', URL::previous()) !!}

                {!! Html::openFormGroup('password', $errors) !!}
                {!! Form::label('email', 'Senha', ['class' => 'control-label']) !!}
                {!! Form::password('password', null, ['class' => 'form-control']) !!}
                {!! Form::error('password', $errors) !!}
                {!! Html::closeFormGroup() !!}
            </div>
            <div class="panel-footer"><center>
                {!! Html::openFormGroup() !!}
                {!! form::submit('Salvar senha', ['class' => 'btn btn-primary']) !!}
                {!! Html::closeFormGroup() !!}</center>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection