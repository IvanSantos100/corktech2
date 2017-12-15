@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de pedido</div>
                <div class="panel-body">
                    <div class="pull-left hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        <br>
                        {!! Form::radio('tipo', '0'); !!}
                        {!! Form::label('Todos', 'Todos', ['class' => 'control-label']) !!}
                        {!! Form::radio('tipo', '1'); !!}
                        {!! Form::label('Entrada', 'Entrada', ['class' => 'control-label']) !!}
                        {!! Form::radio('tipo', '2'); !!}
                        {!! Form::label('Movimentacao', 'Movimentação', ['class' => 'control-label']) !!}
                        {!! Form::radio('tipo', '3'); !!}
                        {!! Form::label('Saida', 'Saída', ['class' => 'control-label']) !!}
                        {!! Form::close()!!}
                    </div>
                     
                    <div class="pull-right hidden-print">
                        <a class="btn btn-primary" href="{{route('admin.pedidos.create')}}">Novo Pedido</a>
                        <a class='btn btn-primary' href="{{route('admin.pedidosencerrados.index',['status' => 2])}}">Encerrados</a>
                    </div>
                    <br><br>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Valor base</th>
                            <th>Desconto</th>
                            <th>Total</th>
                            <th>Valor Final</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td class="col-md-1">{{ $pedido->id}}</td>
                                <td class="col-md-1">{{ $pedido->tipo_nome}}</td>
                                <td class="col-md-2">{{ $pedido->origem->descricao ?? 'Fabrica'}}</td>
                                @if($pedido->destino_id=="")
                                    <td class="col-md-2">
                                        <a class="cursor-pointer"
                                           onclick="popupcliente('{{$pedido->cliente->nome}}','{{$pedido->cliente->tipo}}','{{$pedido->cliente->fone}}')">Cliente
                                            - {{$pedido->cliente->nome}}</a>
                                    </td>
                                @else
                                    <td class="col-md-2">{{ $pedido->destino->descricao}}</td>
                                @endif
                                <td class="col-md-1">{{ $pedido->valor_base }} %</td>
                                <td class="col-md-1">{{ $pedido->desconto}} %</td>
                                <td class="col-md-1">R$ {{number_format(($pedido->valor_total),2, ',', '.') }}</td>
                                <td class="col-md-1">R$ {{number_format(($pedido->valor_final),2, ',', '.') }}</td>
                                <td class="col-md-2 hidden-print">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary'
                                               href="{{ route('admin.itempedido.index', ['pedido' => $pedido->id]) }}"><span
                                                        class='glyphicon glyphicon-list-alt'></span></a>
                                        </li>
                                        <li>
                                            <a class='btn btn-success'
                                               href="{{ route('admin.pedidos.status', ['pedido' => $pedido->id]) }}">
                                                <span class='glyphicon glyphicon-ok'></span></a>
                                        </li>
                                        <li>
                                            @if ($pedido->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                <a class='btn btn-danger'
                                                   href="{{ route('admin.pedidos.show', ['pedido' => $pedido->id]) }}"><span
                                                            class='glyphicon glyphicon-trash'></span></a>
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
                    <div class="hidden-print">{{ $pedidos->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="salvemsg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="Titulomodal"></h4>
                </div>
                <div class="modal-body" id="Corpomodal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/popup.js') }}"></script>
@endpush

