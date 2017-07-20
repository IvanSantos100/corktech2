@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Inclusão de produtos para o pedido:</div>
                <div class="panel-body">

                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>

                    <div class="pull-right">
                        <a class='btn btn-primary'
                           href="{{ route('admin.itempedido.index',['pedidoId' => $pedido->id]) }}">Ver produtos desse
                            pedido
                        </a>
                        <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    </div>
                    <br><br>
                    <div class="well">
                        @foreach($tipo as $t)
                            <a href="{{ "?search=tipoproduto_id:".$t->id}}"
                               class="badge progress-bar-danger">{{$t->descricao}}</a>
                        @endforeach
                    </div>

                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Estampa</th>
                            <th>Tipo produto</th>
                            <th>Classe</th>
                            <th>Lote</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-1">{{ $produto->codigo}} </td>
                                <td class="col-md-2">{{ $produto->descricao}} </td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">{{ $produto->tipoprodutos->descricao}}</td>
                                <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                                <?php $estoques = $produto->estoques->where('centrodistribuicao_id', $pedido->origem_id)?>
                                @if(!$estoques->isEmpty())
                                    <td class="col-md-1">
                                    <tr>
                                    @foreach($estoques as $estoque)
                                    <td class="col-md-1">{{$estoque->lote}}</td>
                                    <td class="col-md-1">{{$estoque->quantidade}}</td>
                                    <td class="col-md-1">R$ {{number_format($estoque->valor,2, ',', '.') }}</td>
                                    <td class="col-md-1">s</td>
                                    <td class="col-md-1">s</td>
                                    @endforeach
                                    </tr>
                                    <td>
                                @else
                                    <td class="col-md-1">{{ $produto->lote }}</td>
                                    <td class="col-md-1">{{ $produto->quantidade }}</td>
                                    <td class="col-md-1">R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                                    <td class="col-md-1">
                                        <?php
                                        $form = "add-form-{$pedido->id}-{$produto->id}";
                                        ?>

                                        {!! Form::open(['route' => ['admin.itempedido.produtos', $pedido->id],
                                            'class' => 'form', 'id' => "$form"]) !!}

                                        {!! form::number('quantidade', 1, ['min' => 1, 'max' => $produto->quantidade]) !!}

                                        {!! form::hidden('produto_id', $produto->id) !!}
                                        {!! form::hidden('lote', $produto->lote) !!}
                                        {!! form::hidden('max', $produto->quantidade) !!}

                                        {!! Form::close() !!}
                                    </td>
                                    <td class="col-md-1">
                                        <a class='btn btn-success' href="#"
                                           onclick="document.getElementById({{"\"$form\""}}).submit();">Add
                                        </a>
                                    </td>

                                @endif
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