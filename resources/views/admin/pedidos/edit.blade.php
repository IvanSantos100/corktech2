@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar pedido</div>
                {!! Form::model($pedido,[
                'route' => ['admin.pedidos.update' , 'class' => $pedido->id],
                'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    @include('admin.pedidos._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Salvar pedido', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection