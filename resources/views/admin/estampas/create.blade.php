@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar Estampa</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.estampas.store', 'class' => 'form']) !!}

                    @include('admin.estampas._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar estampa', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection