@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Classe</div>
                <div class="panel-body">
                    {!! Form::model($classe,[
                    'route' => ['admin.classes.update' , 'class' => $classe->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.classes._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar classe', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection