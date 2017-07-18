@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar pedido de {{ $pedido->tipo_nome}}</div>
                {!! Form::model($pedido,[
                'route' => ['admin.pedidos.update' , 'class' => $pedido->id],
                'class' => 'form', 'method' => 'PUT']) !!}
                <div class="panel-body">
                    {{--<a class="btn btn-success">{{ $pedido->tipo_nome}}</a>--}}
                    @include('admin.pedidos._form')
                </div>
                <div class="panel-footer text-center">
                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar pedido', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection