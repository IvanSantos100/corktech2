@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Orçamento:
                    <b>{{$orcamento->id}}</b>
                </div>
                <div class="panel-body">
                    <div class="col-lg-4 col-sm-12 hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        <div class="input-group">
                            {!! Form::text('search', current($search), ['class' => 'form-control', 'placeholder' => 'Pesquisar por...']) !!}
                            <span class="input-group-btn">
                                {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-lg-8 col-sm-12 hidden-print text-right">
                           {{-- <a class='btn btn-primary'
                               href="{{ route('admin.orcamento.show',['pedidoId' => $orcamento->id]) }}">Ver produtos
                                desse orcamento
                            </a>--}}
                        <a class='btn btn-success' href="{{ route('admin.orcamento.index') }}">Orçamentos</a>
                    </div>
                    <br><br>
                    <div class="well">
                        @foreach($tipo as $t)
                            <a href="{{ "?search=tipoproduto_id:".$t->id}}"
                               class="badge progress-bar-{{$t->id == end($search) ? 'success' : 'danger'}}">{{$t->descricao}}</a>
                        @endforeach
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="col-md-1">Código</th>
                            <th class="col-md-2">Descrição</th>
                            <th class="col-md-2">Estampa</th>
                            <th class="col-md-2">Classe</th>
                            <th class="col-md-1">Tamanho</th>
                            <th class="col-md-1">Estoque</th>
                            <th class="col-md-1">Preço</th>
                            <th class="col-md-1">Qnt</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-1">{{ $produto->codigo}} </td>
                                <td class="col-md-2">{{ $produto->descricao}} </td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">
                                    {{ $produto->classes->descricao}}
                                    @if(!empty($produto))
                                        @if(file_exists("images/thumbnail/estampa-{$produto->estampas->id}.png"))
                                            {{ HTML::image("/images/thumbnail/estampa-{$produto->estampas->id}.png") }}
                                        @endif
                                    @endif
                                </td>
                                <td class="col-md-1">{{ $produto->classes->tamanho}}</td>
                                <td class="col-md-1">{{$produto->getQuantidadeEstoqueAttribute($orcamento->origem_id)}}</td>
                                <td class="col-md-1">
                                    R$ {{number_format( $produto->estoque ? $produto->estoque->valor->first() : $produto->preco,2, ',', '.') }}
                                </td>
                                <td class="col-md-1">

                                    @php
                                        $form = "add-form-{$orcamento->id}-{$produto->id}";
                                    @endphp
                                    {!! Form::open(['route' => ['admin.orcamento.additens', $orcamento->id],
                                                           'class' => 'form', 'id' => "$form"]) !!}
                                        {!! form::hidden('produto_id', $produto->id) !!}
                                        {!! form::number("quantidade", 0, ['min' => 1, 'style' => 'width:100%', 'form' => $form]) !!}
                                    {!! Form::close() !!}

                                </td>
                                <td class="col-md-1">
                                    <a class='btn btn-success text-right' href="#"
                                       onclick="document.getElementById({{"\"$form\""}}).submit();">
                                        <span class='glyphicon glyphicon-plus'></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection