<!DOCTYPE html>
<!--[if IE 9 ]-->
<html class="ie9">
<!--[endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SerEducacional</title>

    {{--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}

    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/fullcalendar/dist/fullcalendar.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/animate.css/animate.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/sweetalert2/dist/sweetalert2.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/datetimepicker/build/jquery.datetimepicker.min.css')}}" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/select2-bootstrap-theme/dist/select2-bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/css/jquery.datetimepicker.css')}}" rel="stylesheet"/>

    {{--<link href="/lib/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">--}}
    {{--<link href="/lib/nouislider/distribute/nouislider.min.css" rel="stylesheet">--}}
    {{--<link href="/lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">--}}
    {{--<link href="/lib/dropzone/dist/min/dropzone.min.css" rel="stylesheet">--}}
    {{--<link href="/lib/farbtastic/farbtastic.css" rel="stylesheet">--}}
    <link href="{{ asset('/lib/chosen/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/summernote/dist/summernote.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/app_1.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/app_2.min.css') }}"  media="screen,projection"/>

    {{-- CSS personalizados--}}
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/demo.css') }}"  media="screen,projection"/>

    @yield('css')
</head>
<body>
<header id="header" class="clearfix" data-ma-theme="blue">
    <ul class="h-inner">
        <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>

        <li class="hi-logo hidden-xs">
            <a href="index.html">SerEducacional</a>
        </li>

        <li class="pull-right">
            <ul class="hi-menu">


                <li class="hidden-xs ma-trigger" data-ma-action="sidebar-open" data-ma-target="#chat">
                    <a href=""><i class="him-icon zmdi zmdi-comment-alt-text"></i></a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Top Search Content -->
    <div class="h-search-wrap">
        <div class="hsw-inner">
            <i class="hsw-close zmdi zmdi-arrow-left" data-ma-action="search-close"></i>
            <input type="text">
        </div>
    </div>
</header>


<section id="main">
    {{--Menu Lateral--}}
    <aside id="sidebar" class="sidebar c-overflow">
        <div class="s-profile">
            <a href="" data-ma-action="profile-menu-toggle">
                <div class="sp-pic">
                    <img src="/dist/img/demo/profile-pics/1.jpg" alt="">
                    {{--{{dd(Auth::user())}}--}}
                    {{--{{Auth::user()->operador()->get()->first()->nome_operadores}}--}}
                </div>

                <div class="sp-info">
                    {{--{{Auth::user()->operador()->get()->first()->nome_operadores}}--}}

                    <i class="zmdi zmdi-caret-down"></i>
                </div>
            </a>

            <ul class="main-menu">
                <li>
                    <a href="profile-about.html"><i class="zmdi zmdi-account"></i>Perfil</a>
                </li>
                {{--<li>
                    <a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                </li>--}}
                <li>
                    <a href=""><i class="zmdi zmdi-settings"></i>Alterar Senha</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><i class="zmdi zmdi-time-restore"></i>Sair</a>
                </li>
            </ul>
        </div>

        <ul class="main-menu">
            <li class="sub-menu">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts-alt"></i>RH</a>
                <ul>
                    <li class="sub-menu">
                        <a href="" data-ma-action="submenu-toggle">CGM</a>
                        <ul>
                            <li>
                                <a href="{{ route('pessoaFisica.index') }}">Pessoa Física</a>
                            </li>
                            <li>
                                <a href="{{ route('pessoaJuridica.index') }}">Pessoa Jurídica</a>
                            </li>
                        </ul>
                </ul>
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-home"></i>Instituição</a>
                <ul>
                    <li>
                        <a href="{{ route('instituicao.edit')  }}">Instituição</a>
                        <a href="{{ route('aluno.index')  }}">Alunos</a>
                        <a href="{{ route('servidor.index')  }}">Servidores</a>
                        <a href="{{ route('curso.index')  }}">Cursos</a>
                        <a href="{{ route('disciplina.index')  }}">Disciplinas</a>
                        <a href="{{ route('curriculo.index')  }}">Currículos</a>
                        <a href="{{ route('escola.index')  }}">Escolas</a>
                    </li>
                </ul>
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-home"></i>Escolas</a>
                <ul>
                    <li>
                        <a href="{{ route('calendario.index')  }}">Calendário</a>
                        <a href="{{ route('formaAvaliacao.index')  }}">Formas de Avaliações</a>
                        <a href="{{ route('procedimentoAvaliacao.index')  }}">Procedimentos de avaliação</a>
                    </li>
                    <li>
                        <a href="{{ route('tipoEvento.index')  }}">Tipo Evento</a>
                    </li>
                </ul>
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-wrench"></i>Parâmetros</a>
                <ul>
                    <li>
                        <a href="{{ route('dependencia.index')  }}"> Dependências</a>
                        <a href="{{ route('cargo.index')  }}"> Cargos</a>
                        <a href="{{ route('modalidadeEnsino.index')  }}">Modalidade de Ensino</a>
                        <a href="{{ route('nivelEnsino.index')  }}">Níveis de Ensino</a>
                        <a href="{{ route('funcao.index')  }}">Funções</a>
                        <a href="{{ route('user.index')  }}">Usuários</a>
                        <a href="{{ route('role.index')  }}">Perfís</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    {{--FIM Menu Lateral--}}

    @yield('content')

</section>

<!-- Page Loader -->
<div class="page-loader">
    <div class="preloader pls-blue">
        <svg class="pl-circular" viewBox="25 25 50 50">
            <circle class="plc-path" cx="50" cy="50" r="20" />
        </svg>

        <p>Please wait...</p>
    </div>
</div>
<!-- -->

<!-- Imagem de carregamento em requisições ajax-->
<div class="modal">
    <div class="preloader pl-xxl">
        <svg class="pl-circular" viewBox="25 25 50 50">
            <circle class="plc-path" cx="50" cy="50" r="20"/>
        </svg>
    </div>
</div>
<!-- -->

<footer id="footer" class="p-t-0">
    <strong>Copyright &copy; 2015-2016 <a target="_blank" href="http://serbinario.com.br"><i></i>SERBINARIO</a> .</strong> Todos os direitos reservados.
</footer>

<!-- Javascript Libraries -->
<script src="{{ asset('/lib/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('/lib/Waves/dist/waves.min.js') }}"></script>
<script src="{{ asset('/dist/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('/lib/bootstrap-growl/jquery.bootstrap-growl.min.js') }}"></script>
<script src="{{ asset('/lib/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/lib/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('/js/jquery.datetimepicker.js')}}" type="text/javascript"></script>

{{--jquery Validator https://jqueryvalidation.org/ --}}
<script src="{{ asset('/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('/lib/jquery-validation/src/additional/cpfBR.js') }}"></script>
<script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/unique.js')  }}"></script>
<script src="{{ asset('/dist/js/fileinput/fileinput.min.js')}}"></script>

{{-- Mascaras https://igorescobar.github.io/jQuery-Mask-Plugin/ --}}
<script src="{{ asset('/lib/jquery-mask-plugin/dist/jquery.mask.js') }}"></script>

<!-- Placeholder for IE9 -->
<script type="text/javascript" src={{ asset('/lib/jquery-placeholder/jquery.placeholder.min.js') }}></script>

<script src="{{ asset('/js/laroute.js') }}"></script>
<script src="{{ asset('/lib/chosen/chosen.jquery.js') }}"></script>
<script type="text/javascript" src={{ asset('/dist/js/app.js') }}></script>

<script type="text/javascript">
    $(".chosen").chosen();
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        mask: false,
        lang: 'pt-BR'
    });

    $.validator.setDefaults({
        ignore: []

    });
</script>

@yield('javascript')

</body>
</html>