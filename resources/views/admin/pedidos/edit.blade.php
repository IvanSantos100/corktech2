@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar pedido</div>
                <div class="panel-body">
                    {!! Form::model($pedido,[
                    'route' => ['admin.pedidos.update' , 'class' => $pedido->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.pedidos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar pedido', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection