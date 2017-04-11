@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Visualizar produto
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Descrição:</label><br>
                                {{ $produto->descricao }}
                            </div>
                            <div class="form-group">
                                <label>Preço:</label><br>
                                {{ $produto->preco }}
                            </div>
                            <div class="form-group">
                                <label>Lote:</label><br>
                                {{ $produto->lote }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Estampa:</label><br>
                                {{ $produto->estampas->descricao }}
                            </div>
                            <div class="form-group">
                                <label>Tipo produto:</label><br>
                                {{ $produto->tipoprodutos->descricao }}
                            </div>
                            <div class="form-group">
                                <label>Classe:</label><br>
                                {{ $produto->classes->descricao }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <center><a class='btn btn-primary' href="{{ route('admin.estoques.index') }}">Voltar</a></center>
                </div>
            </div>
        </div>
    </div>
@endsection
