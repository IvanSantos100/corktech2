@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar Estampa</div>
                {!! Form::open(['route' => 'admin.estampas.store', 'class' => 'form']) !!}
                <div class="panel-body">
                    @include('admin.estampas._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Criar estampa', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection