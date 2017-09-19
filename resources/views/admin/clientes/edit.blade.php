@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar cliente</div>
                {!! Form::model($cliente,[
                   'route' => ['admin.clientes.update' , 'class' => $cliente->id],
                   'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    @include('admin.clientes._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar cliente', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
