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
                                <th colspan="2">Dados do orcamento</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Identificação: {{$itens[0]->pedido->id}}</td>
                                <td>Tipo: Orcamento</td>
                            </tr>
                            <tr>
                                <td>Origem: {{ $itens[0]->pedido->origem->descricao }}</td>
                                <td>Destino: {{ $itens[0]->pedido->cliente ? $itens[0]->pedido->cliente->nome : 'Orçamento' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($itens[0]->pedido->cliente!='')
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="3">Dados do Cliente</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Tipo: @if($itens[0]->pedido->cliente->tipo==1) Física @else Jurídica @endif</td>
                                    <td>Documento: {{$itens[0]->pedido->cliente->documento_formatted}}</td>
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
                                    <td colspan="2">Endereço: {{$itens[0]->pedido->cliente->endereco}}</td>
                                    <td>Bairro: {{$itens[0]->pedido->cliente->bairro}}</td>
                                </tr>
                                <tr>
                                    <td>Cidade: {{$itens[0]->pedido->cliente->cidade}}</td>
                                    <td>UF:{{$itens[0]->pedido->cliente->uf}}</td>
                                    <td>CEP:{{$itens[0]->pedido->cliente->cep}}</td>
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
                                    <td>Telefone: {{$itens[0]->pedido->cliente->fone}}</td>
                                    <td>Celular: {{$itens[0]->pedido->cliente->celular}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="col-lg-4 col-sm-12 hidden-print pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        <div class="input-group">
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquisar por...']) !!}
                            <span class="input-group-btn">
                                {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="pull-right hidden-print">
                        <a class="btn btn-primary"
                           href="{{route('admin.orcamento.additens', ['id' => $itens[0]->pedido_id])}}">Adicionar Produto
                        </a>

                        <a class='btn btn-success' href="{{ route('admin.orcamento.index') }}">Orcamento</a>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
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
                        @foreach($itens as $item)
                            <tr>
                                <td class="col-md-1">{{ $item->produto->codigo}}</td>
                                <td class="col-md-2">{{ $item->produto->descricao}}</td>
                                <td class="col-md-1">
                                    {{$item->produto->classes->descricao}}
                                    @if(!empty($item))
                                        @if(file_exists("images/thumbnail/estampa-{$item->produto->estampas->id}.png"))
                                            {{ HTML::image("/images/thumbnail/estampa-{$item->produto->estampas->id}.png") }}
                                        @endif
                                    @endif
                                </td>
                                <td class="col-md-1">{{ $item->produto->classes->tamanho}}</td>
                                <td class="col-md-1">{{ $item->quantidade}}</td>
                                <td class="col-md-1">
                                    R$ {{ number_format($item->produto->preco,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">
                                    R$ {{ number_format($item->valor_item,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">
                                    R$ {{ number_format(($item->quantidade * $item->valor_item),2, ',', '.') }}
                                </td>
                                <td class="col-md-2 hidden-print">

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal-{{$item->id}}" title="Editar item">
                                        <span class='glyphicon glyphicon-pencil'></span>
                                    </button>

                                    <a class='btn btn-primary' href="{{ route('admin.itempedido.details',
                                    ['pedidoId' => $item->pedido_id, 'produtoId' => $item->produto_id]) }}"
                                       title="Visualizar"><span
                                                class='glyphicon glyphicon-list-alt'></span></a>

                                    @php
                                        $form = "form-$item->id";
                                    @endphp
                                    <a class='btn btn-danger' href="#"
                                       onclick="event.preventDefault(); document.getElementById({{"\"$form\""}}).submit();"
                                       title="Deletar item"><span
                                                class='glyphicon glyphicon-trash'></span></a>

                                    {!! Form::open(['route' => ['admin.orcamento.itens.destroy',
                                        'orcamento' => $item->pedido_id, 'pedidoId' => $item->id],
                                        'id' => "$form",
                                        'method' => 'DELETE', 'style' => 'display:nome']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal-{{$item->id}}" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            Editar item: <strong>{{ $item->produto->descricao}}</strong>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                $form_edit = "form-alt-{$item->id}";
                                            @endphp
                                            {!! Form::open(['route' => ['admin.orcamento.update.item' , 'orcamento' => $item->id],
                                                        'id' => $form_edit, 'method' => 'PUT']) !!}
                                                {!! form::hidden("id", $item->id) !!}
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Quantidade:</label>
                                                    {!! form::number("quantidade", $item->quantidade, ['min' => 1, 'style' => 'width:40%']) !!}
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
                    </div>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td class="col-md-2"><b>TOTAL:</b></td>
                                <td><b>R$ {{number_format(($itens[0]->pedido->valor_total),2, ',', '.') }}</b></td>
                            </tr>
                           {{-- <tr>
                                <td class="col-md-2"><b>DESCONTO:</b></td>
                                <td><b>{{number_format(($itens[0]->pedido->desconto),2, ',', '.') }} %</b></td>
                            </tr>--}}
                            <tr>
                                <td class="col-md-2"><b>VALOR FINAL:</b></td>
                                <td><b>R$ {{number_format($itens[0]->pedido->valor_final, 2, ',', '.') }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="hidden-print">{{ $itens->links() }}</div>
                </div>
                <div class="panel-footer hidden-print text-center">
                    <a class='btn btn-success' href="{{ route('admin.orcamento.index') }}">Salvar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    </script>

@endpush
