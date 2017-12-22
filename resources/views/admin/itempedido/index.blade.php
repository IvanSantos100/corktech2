@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th colspan="2">Dados do Pedido</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Identificação: {{$pedido->id}}</td>
                                <td>Tipo: {{$pedido->tipo_nome}}</td>
                            </tr>
                            <tr>
                                <td>Origem: {{ $pedido->origem->descricao ?? 'Fabrica' }}</td>
                                <td>Destino: {{ $pedido->destino->descricao ?? $pedido->cliente->nome }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($pedido->cliente!='')
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="3">Dados do Cliente</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Tipo: @if($pedido->cliente->tipo==1) Física @else Jurídica @endif</td>
                                    <td>Documento: {{$pedido->cliente->documento_formatted}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="3">Localização do Cliente</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="2">Endereço: {{$pedido->cliente->endereco}}</td>
                                    <td>Bairro: {{$pedido->cliente->bairro}}</td>
                                </tr>
                                <tr>
                                    <td>Cidade: {{$pedido->cliente->cidade}}</td>
                                    <td>UF:{{$pedido->cliente->uf}}</td>
                                    <td>CEP:{{$pedido->cliente->cep}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="2">Contatos do Cliente</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Telefone: {{$pedido->cliente->fone}}</td>
                                    <td>Celular: {{$pedido->cliente->celular}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="pull-left hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right hidden-print">
                        <a class="btn btn-primary"
                           href="{{route('admin.itempedido.produtos', ['pedidoId' => $pedidoId])}}">Adicionar
                            Produto</a>

                        @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                            <a class='btn btn-warning'
                               href="{{ route('admin.pedidos.edit', ['pedido' => $pedido->id]) }}">Editar</a>
                        @else
                            <a class='btn btn-warning' disabled="true">Editar</a>
                        @endif

                        <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    </div>
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Lote</th>
                            <th>Descrição</th>
                            <th>Classe</th>
                            <th>Tamanho</th>
                            <th>Quantidade</th>
                            <th>Valor base</th>
                            <th>Valor item</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0
                        @endphp
                        @foreach($itens_pedidos as $itens_pedido)
                            <tr>
                                <td class="col-md-1">{{ $itens_pedido->produto->codigo}}</td>
                                <td class="col-md-1">{{ $itens_pedido->lote}}</td>
                                <td class="col-md-2">{{ $itens_pedido->produto->descricao}}</td>
                                <td class="col-md-1">
                                    {{$itens_pedido->produto->classes->descricao}}
                                    @if(!empty($itens_pedido))
                                        @if(file_exists("images/thumbnail/estampa-{$itens_pedido->produto->estampas->id}.png"))
                                            {{ HTML::image("/images/thumbnail/estampa-{$itens_pedido->produto->estampas->id}.png") }}
                                        @endif
                                    @endif
                                </td>
                                <td class="col-md-1">{{ $itens_pedido->produto->classes->tamanho}}</td>
                                <td class="col-md-1">{{ $itens_pedido->quantidade}}</td>
                                <td class="col-md-1">
                                    R$ {{ number_format($itens_pedido->produto->preco,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">
                                    R$ {{ number_format($itens_pedido->valor_item,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">
                                    R$ {{ number_format(($itens_pedido->quantidade * $itens_pedido->valor_item),2, ',', '.') }}
                                </td>
                                <td class="col-md-2 hidden-print">

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal-{{$itens_pedido->id}}" title="Editar item">
                                        <span class='glyphicon glyphicon-pencil'></span>
                                    </button>

                                    <a class='btn btn-primary' href="{{ route('admin.itempedido.details',
                                    ['pedidoId' => $itens_pedido->pedido_id, 'produtoId' => $itens_pedido->produto_id]) }}"
                                       title="Visualizar"><span
                                                class='glyphicon glyphicon-list-alt'></span></a>

                                    @php
                                        $form = "form-$itens_pedido->id";
                                    @endphp
                                    <a class='btn btn-danger' href="#"
                                       onclick="event.preventDefault(); document.getElementById({{"\"$form\""}}).submit();"
                                       title="Deletar item"><span
                                                class='glyphicon glyphicon-trash'></span></a>

                                    {!! Form::open(['route' => ['admin.itempedido.produto.delete',
                                        'pedidoId' => $pedidoId,'itempedido' => $itens_pedido->id],
                                        'id' => "$form",
                                        'method' => 'DELETE', 'style' => 'display:nome']) !!}
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                            <div class="modal fade" id="editModal-{{$itens_pedido->id}}" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            Editar item: <strong>{{ $itens_pedido->produto->descricao}}</strong>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                $form_edit = "form-{$itens_pedido->id}";
                                            @endphp
                                            {!! Form::open(['route' => ['admin.itempedido.update' , 'pedido' => $itens_pedido->id],
                                                        'id' => $form_edit, 'method' => 'PUT']) !!}
                                                {!! form::hidden("id", $itens_pedido->id) !!}
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Quantidade:</label>
                                                    {!! form::number("quantidade", $itens_pedido->quantidade, ['min' => 1, 'style' => 'width:40%']) !!}
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Voltar
                                            </button>
                                            <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById({{"\"$form_edit\""}}).submit();">
                                                Editar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        <table>
                            <tr>
                                <td class="col-md-2"><b>TOTAL:</b></td>
                                <td><b>R$ {{number_format(($pedido->valor_total),2, ',', '.') }}</b></td>
                            </tr>
                            <tr>
                                <td class="col-md-2"><b>DESCONTO:</b></td>
                                <td><b>{{number_format(($pedido->desconto),2, ',', '.') }} %</b></td>
                            </tr>
                            <tr>
                                <td class="col-md-2"><b>VALOR FINAL:</b></td>
                                <td><b>R$ {{number_format($pedido->valor_final, 2, ',', '.') }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="hidden-print">{{ $itens_pedidos->links() }}</div>
                </div>
                <div class="panel-footer hidden-print text-center">
                    <a class='btn btn-success' href="{{ route('admin.pedidos.index') }}">Salvar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    </script>

@endpush
