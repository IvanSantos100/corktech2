@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar usuário</div>
                {!! Form::model($usuario,['route' => ['update'],'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    @include('_form')
                </div>
                <div class="panel-footer"><center>
                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar dados', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}</center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection