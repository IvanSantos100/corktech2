@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Inclusão de produtos para o pedido: <b>{{ $pedido->id }}</b> tipo: <b>{{ $pedido->tipo }}</b> destino: <b>{{ $pedido->destino->descricao ?? $pedido->cliente->nome }}</b></div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    @if(!$ver)
                        <div class="pull-right">
                            <a class='btn btn-success pull-right'
                               href="{{ route('admin.itenspedido.index',['pedidoId' => $pedido->id]) }}">Ver produtos desse pedido
                            </a>
                        </div>
                    @endif
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Estampa</th>
                            <th>Tipo produto</th>
                            <th>Classe</th>
                            @if(!$tipo)
                                <th>Lote</th>
                            @endif
                            <th>Preço</th>
                            @if(!$tipo)
                                <th>Estoque</th>
                            @endif
                            <th>Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-2">{{ $produto->descricao}} </td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">{{ $produto->tipoprodutos->descricao}}</td>
                                <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                                @if(!$tipo)
                                    <td class="col-md-1">{{ $produto->lote }}</td>
                                @endif
                                <td class="col-md-2">R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                                @if(!$tipo)
                                    <td class="col-md-1">{{ $produto->quantidade }}</td>
                                @endif
                                <td class="col-md-1">
                                    <?php
                                    $produtoId = $produto->id;
                                    if(!$tipo){
                                        $produtoId = $produto->produto_id;
                                    }

                                    $form = "add-form-{$pedido->id}-{$produtoId}";
                                    ?>

                                    {!! Form::open(['route' => ['admin.itenspedido.produtos', $pedido->id],
                                        'class' => 'form', 'id' => "$form"]) !!}

                                    {!! form::number('quantidade', 1, ['min' => 1, 'max' => $produto->quantidade]) !!}

                                    {!! form::hidden('produto_id', $produtoId) !!}
                                    {!! form::hidden('lote', $produto->lote) !!}
                                    {!! form::hidden('max', $produto->quantidade) !!}

                                    {!! Form::close() !!}
                                </td>
                                <td class="col-md-1">
                                    <a class='btn btn-success' href="#"
                                       onclick="document.getElementById({{"\"$form\""}}).submit();">Add
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection