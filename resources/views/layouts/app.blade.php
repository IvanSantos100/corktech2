<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style >
        @media print {
            .hidden-print {
                display: none !important;
            }
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(Auth::check())
                    <div class="nav navbar-nav">
                        <li><a href="{{ url('admin/clientes') }}">Clientes</a></li>
                        <li><a href="{{ url('admin/usuarios') }}">Usuários</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Pedidos <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.pedidos.index') }}">Pedidos</a></li>
                                <li><a href="{{ route('admin.pedidosencerrados.index',['status' => 2]) }}">Encerrados</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Operacional <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @if(checkPermission(['nacional']))
                                    <li><a href="{{ url('admin/classes') }}">Classes </a></li>
                                    <li><a href="{{ url('admin/estampas') }}">Estampas </a></li>
                                    <li><a href="{{ url('admin/tipoprodutos') }}">Tipo produto </a></li>
                                    <li><a href="{{ url('admin/centrodistribuicoes') }}">Centro distribuições </a></li>
                                    <li role="separator" class="divider"></li>
                                @endif
                                <li><a href="{{ url('admin/produtos') }}">Produtos </a></li>
                                <li><a href="{{ url('admin/estoques') }}">Estoques </a></li>
                            </ul>
                        </li>
                    </div>
            @endif
            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('edit') }}">Alterar Dados </a></li>
                                <li><a href="{{ url('editpassword') }}">Alterar Senha </a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if(Session::has('message'))
        <div class="container">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! Session::get('message') !!}
            </div>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="container">
            @if(!is_array(Session::get('error')))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('error') !!}
                </div>
            @else
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach(Session::get('error') as $key => $error)
                        @if($key == 0)
                            {!! $error !!}
                        @else
                            <li>{!! $error !!}</li>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif
    <div class="row" align="center">{{ HTML::image("/images/corktechlogo.png",'alt', array( 'class' => 'img-responsive', 'width' => '200px' )) }}</div>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://rawgit.com/RobinHerbots/Inputmask/4.x/dist/jquery.inputmask.bundle.js"></script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/4.x/dist/inputmask/phone-codes/phone.js"></script>
<script language="JavaScript">
    $(document).ready(function(){
        $tipo = $(tipo).val();

        if($tipo == 1){
            $(documento).inputmask("999.999.999-99");  //static mask
        }
        if($tipo == 2){
            $(documento).inputmask("99.999.999/9999-99");  //static mask
        }
        $(cep).inputmask("99.999-999");  //static mask
        $(fone).inputmask("(99) 9999[9]-9999"); //specifying options
        $(celular).inputmask("(99) 9999[9]-9999"); //specifying options
    });
</script>
@stack('scripts')
</body>
</html>
