@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Estampa</div>
                <div class="panel-body">
                    {!! Form::model($estampa,[
                    'route' => ['admin.estampas.update' , 'class' => $estampa->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.estampas._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar estampa', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection