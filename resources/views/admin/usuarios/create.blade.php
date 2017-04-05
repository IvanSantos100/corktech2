@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar usuários</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.usuarios.store', 'class' => 'form']) !!}

                    @include('admin.usuarios._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar usuário', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection