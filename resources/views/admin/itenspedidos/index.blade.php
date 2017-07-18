@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de item pedido</div>
                <div class="panel-body">
                    @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                        <div>
                            <a class="btn btn-primary" href="{{route('admin.itempedidos.create')}}">Adicionar produto</a>
                        </div>
                        <br>
                    @endif
                    <div>
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id do pedido</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Prazo de entrega</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itempedidos as $itempedido)
                            <tr>
                                <td class="col-md-2">{{ $itempedido->pedido->id}}</td>
                                <td class="col-md-2">{{ $itempedido->produto->descricao}}</td>
                                <td class="col-md-2">{{ $itempedido->quantidade}}</td>
                                <td class="col-md-2">{{ $itempedido->preco}}</td>
                                <td class="col-md-2">{{ $itempedido->prazoentrega}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-warning' href="{{ route('admin.itempedidos.edit', ['itempedido' => $itempedido->id]) }}">Editar</a>
                                            @else
                                                <a class='btn btn-warning' disabled="true">Editar</a>
                                            @endif
                                        </li>
                                        <li>
                                            @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-danger' href="{{ route('admin.itempedidos.show', ['itempedido' => $itempedido->id]) }}">Excluir</a>
                                            @else
                                                <a class='btn btn-danger' disabled="true">Excluir</a>
                                            @endif
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $itempedidos->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection