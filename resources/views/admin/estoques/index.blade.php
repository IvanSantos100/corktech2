@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de estoque</div>
                <div class="panel-body">
                    <div class="pull-left">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        {!! Form::label('search', 'Pesquisar', ['class' => 'control-label']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close()!!}
                    </div>
                    @if(checkPermission(['nacional']))
                       {{-- <div class="pull-right">
                            <a class="btn btn-primary" href="{{route('admin.estoques.create')}}">Novo estoque</a>
                        </div>
                        <br>--}}
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Produto</th>
                            @if(checkPermission(['nacional']))
                                <th>Centro distribuição</th>
                            @endif
                            <th>Lote</th>
                            <th>Quantidade</th>
                            <th>Valor (unitário)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($estoques as $estoque)
                            <tr>
                                <td class="col-md-2">{{ $estoque->produtos->descricao}}</td>
                                @if(checkPermission(['nacional']))
                                    <td class="col-md-2">{{ $estoque->centroDistribuicoes->descricao}}</td>
                                @endif
                                <td class="col-md-2">{{ $estoque->lote}}</td>
                                <td class="col-md-1">{{ $estoque->quantidade}}</td>
                                <td class="col-md-1">R$ {{number_format($estoque->valor,2, ',', '.') }}</td>
                                <td class="col-md-3">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary' href="{{ route('admin.estoques.details', ['estoque' => $estoque->id]) }}">Detalhar</a>
                                        </li>
                                       {{-- @if(checkPermission(['nacional']))
                                            <li>
                                                <a class='btn btn-warning' href="{{ route('admin.estoques.edit', ['estoque' => $estoque->id]) }}">Editar</a>
                                            </li>
                                            <li>
                                                <a class='btn btn-danger' href="{{ route('admin.estoques.show', ['estoque' => $estoque->id]) }}">Excluir</a>
                                            </li>
                                        @endif--}}
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $estoques->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection