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
                                {{ $produto->produto->descricao }}
                            </div>
                            <div class="form-group">
                                <label>Preço:</label><br>
                                R$ {{ number_format($produto->preco,2, ',', '.')}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Estampa:</label><br>
                                {{ $produto->produto->estampas->descricao }}
                            </div>
                            <div class="form-group">
                                <label>Tipo produto:</label><br>
                                {{ $produto->produto->tipoprodutos->descricao }}
                            </div>
                            <div class="form-group">
                                <label>Classe:</label><br>
                                {{ $produto->produto->classes->descricao }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footerv text-center">
                   <a class='btn btn-primary' href="{{ URL::previous() }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
