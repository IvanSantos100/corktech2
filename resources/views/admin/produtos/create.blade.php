@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar produto</div>
                {!! Form::open(['route' => 'admin.produtos.store', 'class' => 'form']) !!}
                <div class="panel-body">
                    @include('admin.produtos._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Criar produto', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection