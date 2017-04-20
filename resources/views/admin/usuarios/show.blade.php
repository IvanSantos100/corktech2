@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar usuário</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Nome:</label>
                            <div class="col-sm-10">
                                {{ $usuario->name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >E-mail:</label>
                            <div class="col-sm-10">
                                {{ $usuario->email }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Centro de Distribuição:</label>
                            <div class="col-sm-10">
                                {{ $usuario->centroDistribuicoes->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Endereço:</label>
                            <div class="col-sm-10">
                                {{ $usuario->endereco }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Bairro:</label>
                            <div class="col-sm-10">
                                {{ $usuario->bairro }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Cidade:</label>
                            <div class="col-sm-10">
                                {{ $usuario->cidade }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >UF:</label>
                            <div class="col-sm-10">
                                {{ $usuario->uf }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >CEP:</label>
                            <div class="col-sm-10">
                                {{ $usuario->cep }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Fone:</label>
                            <div class="col-sm-10">
                                {{ $usuario->fone }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Celular:</label>
                            <div class="col-sm-10">
                                {{ $usuario->celular }}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <center>
                        {!! Form::open(['route' => ['admin.usuarios.destroy', 'usuario' => $usuario->id], 'id' => $usuario->id, 'method' => 'DELETE']) !!}
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