@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar cliente</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.clientes.store', 'class' => 'form']) !!}

                    @include('admin.clientes._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar cliente', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection