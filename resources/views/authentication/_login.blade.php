<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Material Admin</title>

    <!--CSS Vendor-->
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}"  media="screen,projection"/>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/app_1.min.css') }}"  media="screen,projection"/>
</head>

<body>
<div class="login-content">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        @if(Session::has('errors'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {!! Form::open(['route'=>'attempt', 'method' => "POST" ]) !!}
            {!! csrf_field() !!}

            <div class="lcb-form">
                <div class="form-group">
                    <div class="fg-line">
                        {!! Form::text('email', old('email'), array('class' => 'form-control input-sm', 'placeholder' => 'Login')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="fg-line">
                        {!! Form::password('password', array('class' => 'form-control input-sm', 'placeholder' => 'Senha')) !!}
                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10" type="submit">Logar</button>
            </div>

        {!! Form::close() !!}
    </div>
</div>

<!-- Javascript Libraries -->
<script src="{{ asset('/lib/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/lib/Waves/dist/waves.min.js') }}"></script>
<script type="text/javascript" src={{ asset('/dist/js/app.js') }}></script>

</body>
</html>
