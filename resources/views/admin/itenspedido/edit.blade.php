@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar produto</div>
                <div class="panel-body">
                    <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Estampa</th>
                        <th>Tipo produto</th>
                        <th>Classe</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-2">{{ $produto->descricao}}</td>
                        <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                        <td class="col-md-2">{{ $produto->tipoprodutos->descricao}}</td>
                        <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                        <td class="col-md-2">R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                        <td class="col-md-1">
                            {!! Form::open(['route' => ['admin.itenspedido.produtos', $produto->id],
                                'class' => 'form', 'id' => "add-form-{1}-{$produto->id}"]) !!}

                            {!! form::number('quantidade', 'value', ['min' => 1]) !!}

                            {!! form::hidden('produto_id', $produto->id) !!}

                            {!! Form::close() !!}
                        </td>
                        <td class="col-md-1">
                            <a class='btn btn-success' href="#"
                               onclick="document.getElementById({{"\"add-form-{1}-{$produto->id}\""}}).submit();">Add
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
@endsection