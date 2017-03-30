@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar pedido</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.pedidos.store', 'class' => 'form']) !!}

                    @include('admin.pedidos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar pedido', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection