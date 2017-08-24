@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar estoque</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Produtos:</label>
                            <div class="col-sm-10">
                                {{ $estoque->produtos->descricao}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Centro distribuição:</label>
                            <div class="col-sm-10">
                                {{ $estoque->centroDistribuicoes->descricao}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Lote:</label>
                            <div class="col-sm-10">
                                {{ $estoque->lote}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Valor:</label>
                            <div class="col-sm-10">
                                {{ $estoque->valor}}
                            </div>
                        </div>

                    </form>
                </div>
                <div class="panel-footer">
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <center>
                        {!! Form::open(['route' => ['admin.estoques.destroy', 'estoque' => $estoque->id], 'id' => $estoque->id, 'method' => 'DELETE']) !!}
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