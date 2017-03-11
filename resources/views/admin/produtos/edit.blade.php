@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar tipo produto</div>
                <div class="panel-body">
                    {!! Form::model($tipoproduto,[
                    'route' => ['admin.tipoprodutos.update' , 'class' => $tipoproduto->id],
                    'class' => 'form', 'method' => 'PUT']) !!}

                    @include('admin.tipoprodutos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Salvar tipo produto', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection