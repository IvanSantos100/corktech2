@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar produto</div>
                <div class="panel-body">
                    {!! Form::model($produto,[
                    'route' => ['admin.produtos.update' , 'class' => $produto->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.produtos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar produto', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection