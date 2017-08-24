@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Classe</div>
                {!! Form::model($classe,[
                   'route' => ['admin.classes.update' , 'class' => $classe->id],
                   'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    @include('admin.classes._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar classe', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection