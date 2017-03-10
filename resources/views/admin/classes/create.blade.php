@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar Classe</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.classes.store', 'class' => 'form']) !!}

                    @include('admin.classes._form')

                    {!! Html::openFormGroup() !!}
                    {!! form::submit('Criar classe', ['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection