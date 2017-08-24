@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar cliente</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Tipo:</label>
                            <div class="col-sm-10">
                                {{ $cliente->tipo }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Nome:</label>
                            <div class="col-sm-10">
                                {{ $cliente->nome }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Documento:</label>
                            <div class="col-sm-10">
                                {{ $cliente->documento_formatted }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Endereço:</label>
                            <div class="col-sm-10">
                                {{ $cliente->endereco }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Bairro:</label>
                            <div class="col-sm-10">
                                {{ $cliente->bairro }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Cidade:</label>
                            <div class="col-sm-10">
                                {{ $cliente->cidade }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >UF:</label>
                            <div class="col-sm-10">
                                {{ $cliente->uf }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >CEP:</label>
                            <div class="col-sm-10">
                                {{ $cliente->cep }}
                            </div>
                        </div>
                        @if($cliente->tipo == 2)
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Responsavel:</label>
                            <div class="col-sm-10">
                                {{ $cliente->responsavel }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Fone:</label>
                            <div class="col-sm-10">
                                {{ $cliente->fone }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Celular:</label>
                            <div class="col-sm-10">
                                {{ $cliente->celular }}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <center>
                        {!! Form::open(['route' => ['admin.clientes.destroy', 'cliente' => $cliente->id], 'id' => $cliente->id, 'method' => 'DELETE']) !!}
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