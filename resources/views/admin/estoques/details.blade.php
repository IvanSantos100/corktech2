@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar produto</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Descrição:</label>
                            <div class="col-sm-10">
                                {{ $produto->descricao }}
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Preço:</label>
                                <div class="col-sm-10">
                                    {{ $produto->preco }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Estampa:</label>
                                <div class="col-sm-10">
                                    {{ $produto->estampas->descricao }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Tipo produto:</label>
                                <div class="col-sm-10">
                                    {{ $produto->tipoprodutos->descricao }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Classe:</label>
                                <div class="col-sm-10">
                                    {{ $produto->classes->descricao }}
                                </div>
                            </div>
                        <div>
                        <a class='btn btn-primary' href="{{ route('admin.estoques.index') }}">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection