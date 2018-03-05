@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de orcamento</div>
                <div class="panel-body">
                    <div class="col-lg-3 col-sm-12 hidden-print">
                        {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
                        <div class="input-group">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquisar por...']) !!}
                            <span class="input-group-btn">
                        {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-6 col-sm-12 hidden-print">

                    </div>
                    <div class="col-lg-3 col-sm-12 hidden-print">
                        <a class="btn btn-primary" href="{{route('admin.orcamento.create')}}">Novo orcamento</a>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Total</th>
                            <th>Valor Final</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orcamentos as $orcamento)
                            <tr>
                                <td class="col-md-1">{{ $orcamento->id}}</td>
                                <td class="col-md-2">{{ $orcamento->origem->descricao ?? 'Fabrica'}}</td>
                                <td class="col-md-2">
                                    <span>Orçamento</span>
                                </td>
                                <td class="col-md-2">R$ {{number_format(($orcamento->valor_total),2, ',', '.') }}</td>
                                <td class="col-md-2">R$ {{number_format(($orcamento->valor_final),2, ',', '.') }}</td>
                                <td class="col-md-2 hidden-print text-right">
                                    <ul class="list-inline">
                                        <li>
                                            <a class='btn btn-primary'
                                               href="{{ route('admin.orcamento.itens', ['orcamento' => $orcamento->id]) }}" title="Visualizar"><span
                                                        class='glyphicon glyphicon-list-alt'></span></a>
                                        </li>
                                        <li>
                                            @if ($orcamento->status == 1 || Auth::user()->centrodistribuicao_id==1)
                                                {!! Form::open(['route' => ['admin.orcamento.destroy', 'orcamento' => $orcamento->id],
                                                    'method' => 'DELETE', 'style' => 'display:nome']) !!}
                                                <button  class='btn btn-danger' type="submit" ><span class='glyphicon glyphicon-trash'></span></button>
                                                {!! Form::close() !!}
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
                    </div>
                    <div class="hidden-print">{{ $orcamentos->links() }}</div>
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

