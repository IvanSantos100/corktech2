@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar centro distribuição</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $centrodistribuicao->descricao}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $centrodistribuicao->tipo}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $centrodistribuicao->prazo_fabrica}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $centrodistribuicao->prazo_nacional}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $centrodistribuicao->prazo_regional}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $centrodistribuicao->valor_base}}
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
                        {!! Form::open(['route' => ['admin.centrodistribuicoes.destroy', 'centrodistribuicao' => $centrodistribuicao->id], 'id' => $centrodistribuicao->id, 'method' => 'DELETE']) !!}
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