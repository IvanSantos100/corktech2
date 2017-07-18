@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Adicionar produtos</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.itempedidos.store', 'class' => 'form']) !!}

                    @include('admin.itempedidos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Adicionar produto', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection