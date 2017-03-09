@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Criar Classe</h3>

            {!! Form::open(['route' => 'admim.classes.store', 'class' => 'form']) !!}

            @include('admin.classes._form')

            {!! Html::openFormGroup() !!}
            {!! form::submit('Criar classe', ['class' => 'btn btn-primary']) !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection