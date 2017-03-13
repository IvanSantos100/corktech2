@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar centro distribuicao</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.centrodistribuicoes.store', 'class' => 'form']) !!}

                    @include('admin.centrodistribuicoes._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar centro distribuicao', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection