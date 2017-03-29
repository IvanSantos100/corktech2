@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar cliente</div>
                <div class="panel-body">
                    {!! Form::model($cliente,[
                    'route' => ['admin.clientes.update' , 'class' => $cliente->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.clientes._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar cliente', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection