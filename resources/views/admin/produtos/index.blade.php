@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de produto</div>
                <div class="panel-body">
                    <div class="pull-left hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    @if(checkPermission(['nacional']))
                        <div class="pull-right hidden-print">
                            <a class="btn btn-primary" href="{{route('admin.produtos.create')}}">Novo produto</a>
                        </div>
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descrição</th>
                            <th>Estampa</th>
                            <th>Tipo produto</th>
                            <th>Classe</th>
                            <th>Preço</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="col-md-1">{{ $produto->codigo}}</td>
                                <td class="col-md-2">{{ $produto->descricao}}</td>
                                <td class="col-md-2">{{ $produto->estampas->descricao}}</td>
                                <td class="col-md-2">{{ $produto->tipoprodutos->descricao}}</td>
                                <td class="col-md-2">{{ $produto->classes->descricao}}</td>
                                <td class="col-md-1">R$ {{number_format($produto->preco,2, ',', '.') }}</td>
                                @if(checkPermission(['nacional']))
                                    <td class="col-md-2 hidden-print">
                                        <ul class="list-inline">
                                            <li>
                                                <a class='btn btn-warning'
                                                   href="{{ route('admin.produtos.edit', ['produto' => $produto->id]) }}"><span class='glyphicon glyphicon-edit'></span></a>
                                            </li>
                                            <li>
                                                <a class='btn btn-danger'
                                                   href="{{ route('admin.produtos.show', ['produto' => $produto->id]) }}"><span class='glyphicon glyphicon-trash'></span></a>
                                            </li>
                                        </ul>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="hidden-print">{{ $produtos->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection