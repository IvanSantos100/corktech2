@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de cliente</div>
                <div class="panel-body">
                    <div>
                       <a class="btn btn-primary" href="{{route('admin.clientes.create')}}">Novo cliente</a>
                    </div>
                    <br>
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
                            <th>Tipo</th>
                            <th>Nome</th>
                            <th>Documento</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td class="col-md-2">{{ $cliente->tipo}}</td>
                                <td class="col-md-2">{{ $cliente->nome}}</td>
                                <td class="col-md-2">{{ $cliente->documento}}</td>
                                <td class="col-md-2">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-warning' href="{{ route('admin.clientes.edit', ['cliente' => $cliente->id]) }}">Editar</a>
                                        </li>
                                        <li>
                                            <a class='btn btn-danger' href="{{ route('admin.clientes.show', ['cliente' => $cliente->id]) }}">Excluir</a>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection