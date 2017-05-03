@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Estampa</div>
                {!! Form::model($estampa,[
                   'route' => ['admin.estampas.update' , 'class' => $estampa->id],
                   'class' => 'form', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel-body">
                    @include('admin.estampas._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar estampa', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection