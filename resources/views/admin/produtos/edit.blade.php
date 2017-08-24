@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar produto</div>
                {!! Form::model($produto,[
                    'route' => ['admin.produtos.update' , 'class' => $produto->id],
                    'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    @include('admin.produtos._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar produto', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection