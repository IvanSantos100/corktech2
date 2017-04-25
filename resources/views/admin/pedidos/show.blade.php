@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizar pedido</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" >ID:</label>
                            <div class="col-sm-10">
                                {{ $pedido->id }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Origen:</label>
                            <div class="col-sm-10">
                                {{ $pedido->origem->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Destino:</label>
                            <div class="col-sm-10">
                                {{ $pedido->destino->descricao }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Preço:</label>
                            <div class="col-sm-10">
                                {{ $pedido->valor_base }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Desconto:</label>
                            <div class="col-sm-10">
                                {{ $pedido->desconto }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Data criação:</label>
                            <div class="col-sm-10">
                                {{ $pedido->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Total de produtos:</label>
                            <div class="col-sm-10">
                                {{ $pedido->produtos->count() }}
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-danger">
                        Deseja realmente excluir?.
                    </div>
                    <div>
                        {!! Form::open(['route' => ['admin.pedidos.destroy', 'pedido' => $pedido->id], 'id' => $pedido->id, 'method' => 'DELETE']) !!}
                        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-success">Voltar</a>
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection