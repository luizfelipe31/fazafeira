<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$title?> | FazAFeira - E-commerce</title>
    <link href="{{url(mix('backend/assets/css/libs.css'))}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <![endif]-->
    <link rel="shortcut icon" href="{{url(asset('backend/assets/images/logo2.png'))}}">

    @hasSection('css')
        @yield('css')
    @endif

    <meta name='csrf-token' content="{{ csrf_token() }}">

</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +21 2222-2222</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-3 clearfix">
                    <div class="logo pull-left">
                        <a href="{{ route('index') }}"><img src="{{url(asset('backend/assets/images/logo2.png'))}}" alt="" /></a>
                    </div>

                </div>
                <div class="col-md-9 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('index') }}"><i class="fa fa-arrow-left"></i> Voltar para loja</a></li>
                            <li><a href="{{ route('admin') }}"> Produtos</a></li>
                            <li><a href="{{ route('admin.brand') }}"> Marcas</a></li>
                            <li><a href="{{ route('admin.wish') }}"> Lista de Desejos</a></li>
                            <li><a href="{{ route('admin.sale') }}"> Vendas</a></li>
                            <li><a href="{{ route('admin.menssage') }}"> Mensagens</a>
                            <li><a href="{{ route('admin.user') }}"> Usuarios</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" style="color:red"></i> Logout</a></li>
                          </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">

        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

@if (session('success'))

    <div class="alert alert-success" align="center">
        {{ session('success') }}
    </div>

@endif
@if (session('danger'))

    <div class="alert alert-danger" align="center">
        {{ session('danger') }}
    </div>

@endif
@if($errors->all())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" align="center">
            {{ $error }}
        </div>
    @endforeach
@endif

 @yield('content')

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <p class="pull-left">Copyright © 2021 FazAFeira. Todos os direitos reservados.</p>
            <p class="pull-right"></span></p>
        </div>
    </div>
</div>



<script src="{{url(mix('backend/assets/js/jquery.js'))}}"></script>
<script src="{{url(mix('backend/assets/js/libs.js'))}}"></script>
<script src="{{url(mix('backend/assets/js/scripts.js'))}}"></script>

    @hasSection('js')
        @yield('js')
    @endif

</body>
</html>
