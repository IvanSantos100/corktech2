@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de cliente</div>
                <div class="panel-body">
                    <div class="pull-left  hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    <div class="pull-right  hidden-print">
                        <a class="btn btn-primary" href="{{route('admin.clientes.create', 'cpf=true')}}">Novo cliente físico</a>
                        <a class="btn btn-primary" href="{{route('admin.clientes.create', 'cnpj=true')}}">Novo cliente jurídico</a>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Nome</th>
                            <th>Documento</th>
                            <th>Centro de Distribuição</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td class="col-md-2">{{ $cliente->tipo}}</td>
                                <td class="col-md-2">{{ $cliente->nome}}</td>
                                <td class="col-md-2">{{ $cliente->documento_formatted}}</td>
                                <td class="col-md-2">{{ $cliente->centroDistribuicoes->descricao ?? ''}}</td>
                                    <td class="col-md-3  hidden-print">
                                        <ul class="list-inline">
                                            <li>
                                                <a class="btn btn-primary" href="{{ route('admin.pedidos.cliente', ['cliente' => $cliente->id]) }}"><span class="glyphicon glyphicon-list-alt"></span></a>
                                            </li>
                                            <li>
                                                <a class='btn btn-warning'
                                                   href="{{ route('admin.clientes.edit', ['cliente' => $cliente->id]) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                            </li>
                                            <li>
                                                <a class='btn btn-danger'
                                                   href="{{ route('admin.clientes.show', ['cliente' => $cliente->id]) }}"><span class="glyphicon glyphicon-trash"></span></a>
                                            </li>
                                        </ul>
                                    </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="hidden-print">{{ $clientes->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
