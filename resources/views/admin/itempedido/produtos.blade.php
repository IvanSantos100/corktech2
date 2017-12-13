@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <?php $nomeTipoDestino = $pedido->origem_id ? $pedido->destino_id ? $pedido->destino->TipoNome : 'o cliente' : null ?>
                <div class="panel-heading">
                    Inclusão de produtos para o pedido:
                    <b>{{$pedido->id}}</b>
                    de
                    <b>{{$pedido->TipoNome}}</b>
                    da
                    <b>{{ $pedido->origem->descricao ?? 'Fabrica' }}</b>
                    para {{$nomeTipoDestino}}
                    <b>{{$pedido->destino->descricao ?? $pedido->cliente->nome}}</b>
                </div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', current($search), ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>

                    <div class="pull-right">
                        @if(!$pedido->produtos->isEmpty())
                            <a class='btn btn-primary'
                               href="{{ route('admin.itempedido.index',['pedidoId' => $pedido->id]) }}">Ver produtos
                                desse
                                pedido
                            </a>
                        @endif
                        <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    </div>
                    <br><br>
                    <div class="well">
                        @foreach($tipo as $t)
                            <a href="{{ "?search=tipoproduto_id:".$t->id}}"
                               class="badge progress-bar-{{$t->id == end($search) ? 'success' : 'danger'}}">{{$t->descricao}}</a>
                        @endforeach
                    </div>

                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="col-md-1">Código</th>
                            <th class="col-md-2">Descrição</th>
                            <th class="col-md-2">Estampa</th>
                            <th class="col-md-2">Classe</th>
                            <th class="col-md-1">Tamanho</th>
                            <th class="col-md-5">
                                <table>
                                    <tr>
                                        <th class="col-md-1">Lote</th>
                                        <th class="col-md-1">Estoque</th>
                                        <th class="col-md-1">Preço</th>
                                        <th class="col-md-1">Qnt</th>
                                    </tr>
                                </table>
                            <th>
                            <td class="col-md-1"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-1">{{ $produto->codigo}} </td>
                                <td class="col-md-2">{{ $produto->descricao}} </td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                                <td class="col-md-1">{{ $produto->classes->tamanho}}</td>
                                <?php $estoques = $produto->estoques->where('centrodistribuicao_id', $pedido->origem_id)?>
                                @if(!$estoques->isEmpty())
                                    <td class="col-md-3">
                                        <?php
                                        $form = "add-form-{$pedido->id}-{$produto->id}";
                                        ?>
                                        {!! Form::open(['route' => ['admin.itempedido.produtos', $pedido->id],
                                                        'class' => 'form', 'id' => "$form"]) !!}
                                        {!! form::hidden('produto_id', $produto->id) !!}

                                        <table>
                                            @foreach($estoques as $key => $estoque)
                                                <tr>
                                                    <td class="col-md-1">{{ $estoque->lote}}</td>
                                                    <td class="col-md-1">{{$estoque->quantidade}}</td>
                                                    <td class="col-md-1">
                                                        R$ {{number_format($estoque->valor,2, ',', '.') }}</td>
                                                    <td class="col-md-1">
                                                        {!! form::number("quantidade[]", 0, ['min' => 1, 'style' => 'width:100%', 'form' => $form]) !!}
                                                        {!! form::hidden("lote[]", $estoque->lote) !!}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="col-md-1">
                                        <a class='btn btn-success' href="#"
                                           onclick="document.getElementById({{"\"$form\""}}).submit();"><span
                                                    class='glyphicon glyphicon-plus'></span>
                                        </a>
                                    </td>
                                @else
                                    <td class="col-md-3">
                                        <table>
                                            <tr>
                                                <td class="col-md-1">{{ $produto->lote}}</td>
                                                <td class="col-md-1">{{ $produto->quantidade}}</td>
                                                <td class="col-md-1">
                                                    R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                                                <td class="col-md-1">
                                                    <?php
                                                    $form = "add-form-{$pedido->id}-{$produto->id}";
                                                    ?>

                                                    {!! Form::open(['route' => ['admin.itempedido.produtos', $pedido->id],
                                                        'class' => 'form', 'id' => "$form"]) !!}

                                                    {!! form::number('quantidade[]', 0, ['min' => 1, 'style' => 'width:100%', 'step' => '0.1']) !!}

                                                    {!! form::hidden('produto_id', $produto->id) !!}
                                                    {!! form::hidden('lote[]', $produto->lote) !!}

                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="col-md-1">
                                        <a class='btn btn-success' href="#"
                                           onclick="document.getElementById({{"\"$form\""}}).submit();"><span
                                                    class='glyphicon glyphicon-plus'></span>
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
@endsection