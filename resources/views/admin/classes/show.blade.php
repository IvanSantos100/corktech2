@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar Classe</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Descrição:</label>
                            <div class="col-sm-10">
                                {{ $classe->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Tamanho:</label>
                            <div class="col-sm-10">
                                {{ $classe->tamanho }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Espessura:</label>
                            <div class="col-sm-10">
                                {{ $classe->espessura }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Atacado:</label>
                            <div class="col-sm-10">
                                {{ $classe->atacado }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Varejo:</label>
                            <div class="col-sm-10">
                                {{ $classe->varejo }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Granel:</label>
                            <div class="col-sm-10">
                                {{ $classe->granel }}
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <div>
                        {!! Form::open(['route' => ['admin.classes.destroy', 'classe' => $classe->id], 'id' => $classe->id, 'method' => 'DELETE']) !!}
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-success">Voltar</a>
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection