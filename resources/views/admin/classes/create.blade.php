@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar Classe</div>
                {!! Form::open(['route' => 'admin.classes.store', 'class' => 'form']) !!}
                <div class="panel-body">
                    @include('admin.classes._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Criar classe', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection