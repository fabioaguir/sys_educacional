<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>SerEducacional</title>

    <!-- -->
    <link href="{{ asset('/lib/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/dist/fonts/font-awesome/css/font-awesome.css')}}" />

    <!-- Ionicons -->
    <link href="{{ asset('/dist/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('/dist/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('/dist/css/_all-skins.min.css')}}" />

    <!-- -->
    <link rel="stylesheet" href="{{asset('/dist/css/cs-login.css')}}" />
    <link rel="stylesheet" href="{{asset('/dist/css/select2.min.css')}}" />

    {{--<link rel="icon" type="image/x-icon" href="{{ asset('logo_sistema_menu_sbl.ico') }}" />--}}
</head>

<body class="skin-red sidebar-mini wysihtml5-supported fixed" style="background-position: 119px 27px, 63px center;">

<div class="wrapper">
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default" style="margin-top: -50px">
                    <div class="panel-heading">
                        <div class="row-fluid user-row">
                            <center>
                                <h3>SerEducacional</h3>
                            </center>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- alerta -->
                        @if(Session::has('errors'))
                            <div class="alert alert-danger">
                                @lang('auth.failed')<br>
                            </div>
                            @endif

                            <!-- logo -->
                            <div class="login-logo">
                                <center><img id="logo" src="{{ asset('/dist/img/logo_igarassu.png') }}"
                                             class="img-responsive" alt="Logo"/></center>
                            </div>

                            <!-- formulário -->
                            {!! Form::open(['route'=>'attempt', 'method' => "POST" ]) !!}
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback">
                                {!! Form::text('email', old('email'), array('class' => 'form-control', 'id'=>'email', 'placeholder' => 'Login', 'required' => 'required', 'autofocus' => 'autofocus')) !!}
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                                {{--{!! Form::password('password', Session::getOldInput('password'), array('class' => 'form-control', 'id'=>'password', 'required' => 'required')) !!}--}}
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Entrar</button>
                                </div>
                            </div>

                            {!! Form::close() !!}

                            <center>
                                <strong>
                                    Copyright © 2004-2015
                                    <a target="__blanck" href="http://www.serbinario.com.br/">Serbinário</a>
                                    <br>
                                </strong>
                                Todos os direitos reservados.
                            </center>

                            <center>
                                <img class="img-responsive" src="{{ asset('/dist/img/serbinario_logo.png') }}" style="margin-bottom:                                        15px; margin-top: 10px" width="200" height="100">
                            </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wrapper -->

<!-- bibliotecas -->
<script type="text/javascript" src="{{ asset('/lib/jquery/dist/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/lib/bootstrap/dist/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('/lib/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('/lib/fastclick/lib/fastclick.js') }}"></script>
<script type="text/javascript" src="{{ asset('/dist/js/app_2.min.js') }}"></script>