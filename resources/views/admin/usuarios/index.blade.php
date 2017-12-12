@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Listagem de usuários</div>
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
                            <a class="btn btn-primary" href="{{route('admin.usuarios.create')}}">Novo usuário</a>
                        </div>
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Centro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td class="col-md-2"> 
                                    <a class="cursor-pointer"
                                           onclick="popupusuario('{{$usuario->name}}','{{$usuario->email}}','{{$usuario->endereco}}','{{$usuario->bairro}}','{{$usuario->cidade}}','{{$usuario->uf}}','{{$usuario->cep}}','{{$usuario->fone}}','{{$usuario->celular}}','{{$usuario->centroDistribuicoes->descricao}}')">
                                           {{ $usuario->name}}
                                    </a>
                                </td>
                                <td class="col-md-2">{{ $usuario->email}}</td>
                                <td class="col-md-2">{{ $usuario->centroDistribuicoes->descricao}}</td>
                                @if(checkPermission(['nacional']))
                                    <td class="col-md-2  hidden-print">
                                        <ul class="list-inline">
                                            <li>
                                                <a class='btn btn-warning'
                                                   href="{{ route('admin.usuarios.edit', ['usuario' => $usuario->id]) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                            </li>
                                            <li>
                                                <a class='btn btn-danger'
                                                   href="{{ route('admin.usuarios.show', ['usuario' => $usuario->id]) }}"><span class="glyphicon glyphicon-trash"></span></a>
                                            </li>
                                        </ul>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="hidden-print">{{ $usuarios->links() }}</div>
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