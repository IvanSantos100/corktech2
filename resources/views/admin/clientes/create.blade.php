@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Criar cliente</div>
                {!! Form::open(['route' => 'admin.clientes.store', 'class' => 'form']) !!}
                <div class="panel-body">
                    @include('admin.clientes._form')
                </div>
                <div class="panel-footer">
                    <center>
                        {!! Html::openFormGroup() !!}
                        {!! form::submit('Criar cliente', ['class' => 'btn btn-primary']) !!}
                        {!! Html::closeFormGroup() !!}
                    </center>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection
@push('style')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/mask.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#centrodistribuicao').select2();
        });
    </script>
@endpush
