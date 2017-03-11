@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar tipo produto</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.tipoprodutos.store', 'class' => 'form']) !!}

                    @include('admin.tipoprodutos._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar tipo produto', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection