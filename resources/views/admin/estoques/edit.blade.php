@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar estoque</div>
                <div class="panel-body">
                    {!! Form::model($estoque,[
                    'route' => ['admin.estoques.update' , 'class' => $estoque->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.estoques._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar estoque', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection