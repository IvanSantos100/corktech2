@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar produto</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.produtos.store', 'class' => 'form']) !!}

                    @include('admin.produtos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar produto', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection