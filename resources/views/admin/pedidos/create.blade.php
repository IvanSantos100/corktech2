@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar pedido</div>
                {!! Form::open(['route' => 'admin.pedidos.store', 'class' => 'form']) !!}
                <div class="panel-body">
                    <div class="panel-body">
                        @foreach($opcao as $k => $val)
                            <a href="{{ route('admin.pedidos.create',['tipo' => $k]) }}" class="btn {{$tipo == $k ? 'btn-success' : 'btn-default'}}">{{$val}}</a>
                        @endforeach
                        <br>
                        @include('admin.pedidos._form')
                    </div>
                    <div class="panel-footer text-center">
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Criar pedido', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection