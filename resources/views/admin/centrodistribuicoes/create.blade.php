@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar centro distribuicao</div>
                {!! Form::open(['route' => 'admin.centrodistribuicoes.store', 'class' => 'form']) !!}
                <div class="panel-body">
                    @include('admin.centrodistribuicoes._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Criar centro distribuicao', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection