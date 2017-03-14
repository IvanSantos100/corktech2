@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar estoque</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.estoques.store', 'class' => 'form']) !!}

                    @include('admin.estoques._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar estoque', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection