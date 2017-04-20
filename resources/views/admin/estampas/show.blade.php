@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar Estampa</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $estampa->descricao }}
                            </div>
                        </div>
                    </form>
                    <div>

                    </div>
                </div>
                <div class="panel-footer">
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <center>
                        {!! Form::open(['route' => ['admin.estampas.destroy', 'estampa' => $estampa->id], 'id' => $estampa->id, 'method' => 'DELETE']) !!}
                        {!! Form::hidden('redirect_to', URL::previous()) !!}
                        <a href="{{ URL::previous() }}" class="btn btn-success">Voltar</a>
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection