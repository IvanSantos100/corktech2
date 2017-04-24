@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de produto</div>
                <div class="panel-body">
                    <br>
                    <div>
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}

                        <a class='btn btn-success pull-right' href="{{ route('admin.itenspedido.index',['pedidoId' => $pedidoId]) }}">Voltar</a>
                    </div>
                    <table class="table table-hover table-striped">
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
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-2">{{ $produto->descricao}}</td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">{{ $produto->tipoprodutos->descricao}}</td>
                                <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                                <td class="col-md-2">R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                                <td class="col-md-1">
                                    {!! Form::open(['route' => ['admin.itenspedido.produtos', $pedidoId],
                                        'class' => 'form', 'id' => "add-form-{$pedidoId}-{$produto->id}"]) !!}

                                        {!! form::number('quantidade', 1, ['min' => 1]) !!}

                                        {!! form::hidden('produto_id', $produto->id) !!}

                                    {!! Form::close() !!}
                                </td>
                                <td class="col-md-1">
                                    <a class='btn btn-success' href="#"
                                       onclick="document.getElementById({{"\"add-form-{$pedidoId}-{$produto->id}\""}}).submit();">Add
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