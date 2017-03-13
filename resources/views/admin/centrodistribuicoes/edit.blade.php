@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar centro distribuição</div>
                <div class="panel-body">
                    {!! Form::model($centrodistribuicao,[
                    'route' => ['admin.centrodistribuicoes.update' , 'class' => $centrodistribuicao->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.centrodistribuicoes._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar centro distribuição', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection