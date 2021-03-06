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
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/lib/select2-bootstrap-theme/dist/select2-bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/fonts/iconfont/material-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/plugins/botao/botao-fab.css')  }}">

    <!-- Datepicker -->
    <link type="text/css" rel="stylesheet" href="{{ asset('lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/validate.css') }}"  media="screen,projection"/>

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

        <li class="pull-left">
            <ul class="hi-menu">
                <li class="hidden-xs ma-trigger" data-ma-action="sidebar-open" data-ma-target="#chat">
                    <a href="" id="trocar-escola" style="text-transform: uppercase; left: 85px; top: 10px">@if(Session::has('escola')) {{ Session::get('escola')->nome }} @endif</a>
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
                    <img src="{{ asset ('/dist/img/demo/profile-pics/1.jpg') }}" alt="">
                    {{--{{dd(Auth::user())}}--}}
                    {{--{{Auth::user()->operador()->get()->first()->nome_operadores}}--}}
                </div>

                <div class="sp-info">
                    {{ Auth::user()->name }}
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
            </a>

            <ul class="main-menu">
                {{--<li>
                    <a href="profile-about.html"><i class="zmdi zmdi-account"></i>Perfil</a>
                </li>
                <li>
                    <a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                </li>--}}
                <li>
                    <a href="{{ route('user.alterarSenha') }}"><i class="zmdi zmdi-settings"></i>Alterar Senha</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><i class="zmdi zmdi-time-restore"></i>Sair</a>
                </li>
            </ul>
        </div>

        <ul class="main-menu">
            <li class="sub-menu">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-wrench"></i>Parâmetros</a>
                <ul>
                    @permission('instituicao.update')
                    <li>
                        <a href="{{ route('instituicao.edit')  }}">Instituição</a>
                    </li>
                    @endpermission

                    @permission('forma.avaliacao.select|forma.avaliacao.store|forma.avaliacao.update|forma.avaliacao.destroy')
                    <li>
                        <a href="{{ route('formaAvaliacao.index')  }}">Formas de Avaliações</a>
                    </li>
                    @endpermission

                    @permission('periodo.select|periodo.store|periodo.update|periodo.destroy')
                    <li>
                        <a href="{{ route('periodo.index')  }}">Períodos de avaliação</a>
                    </li>
                    @endpermission

                    @permission('tipo.evento.select|tipo.evento.store|tipo.evento.update|tipo.evento.destroy')
                    <li>
                        <a href="{{ route('tipoEvento.index')  }}">Tipo Evento</a>
                    </li>
                    @endpermission

                    @permission('parecer.select|parecer.store|parecer.update|parecer.destroy')
                    <li>
                        <a href="{{ route('parecer.index')  }}"> Pareceres</a>
                    </li>
                    @endpermission

                    @permission('disciplina.select|disciplina.store|disciplina.update|disciplina.destroy')
                    <li>
                        <a href="{{ route('disciplina.index') }}">Disciplinas</a>
                    </li>
                    @endpermission

                    @permission('modalidade.select|modalidade.store|modalidade.update|modalidade.destroy')
                    <li>
                        <a href="{{ route('modalidadeEnsino.index')  }}">Modalidade de Ensino</a>
                    </li>
                    @endpermission

                    @permission('nivel.select|nivel.store|nivel.update|nivel.destroy')
                    <li>
                        <a href="{{ route('nivelEnsino.index')  }}">Níveis de Ensino</a>
                    </li>
                    @endpermission

                    @permission('curso.select|curso.store|curso.update|curso.destroy')
                    <li>
                        <a href="{{ route('curso.index')  }}">Cursos</a>
                    </li>
                    @endpermission

                    {{--@permission('procedimento.avaliacao.select|procedimento.avaliacao.store|procedimento.avaliacao.update|procedimento.avaliacao.destroy')
                    <a href="{{ route('procedimentoAvaliacao.index')  }}">Procedimentos de avaliação</a>
                    @endpermission--}}

                </ul>

                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-home"></i>Escolas</a>
                <ul>

                    @permission('escola.select|escola.store|escola.update|escola.destroy')
                    <li>
                        <a href="{{ route('escola.index')  }}">Escolas</a>
                    </li>
                    @endpermission

                    @permission('curriculo.select|curriculo.store|curriculo.update|curriculo.destroy')
                    <li>
                        <a href="{{ route('curriculo.index')  }}">Matriz Curricular</a>
                    </li>
                    @endpermission

                    @permission('calendario.select|calendario.store|calendario.update|calendario.destroy')
                    <li>
                        <a href="{{ route('calendario.index')  }}">Calendário</a>
                    </li>
                    @endpermission

                    @permission('turma.select|turma.store|turma.update|turma.destroy')
                    <li>
                        <a href="{{ route('turma.index')  }}">Turmas</a>
                    </li>
                    @endpermission

                    @permission('turma.complementar.select|turma.complementa.store|turma.complementa.update|turma.complementa.destroy')
                    <li>
                        <a href="{{ route('turmaComplementar.index')  }}">Turmas Complementares</a>
                    </li>
                    @endpermission

                    @permission('aluno.select|aluno.store|aluno.update|aluno.destroy')
                    <li>
                        <a href="{{ route('aluno.index') }}">Alunos</a>
                    </li>
                    @endpermission

                </ul>

                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts-alt"></i>RH</a>
                <ul>
                    <li class="sub-menu">
                        <a href="" data-ma-action="submenu-toggle">CGM</a>
                        <ul>
                            @permission('pessoa.fisica.select|pessoa.fisica.store|pessoa.fisica.update|pessoa.fisica.destroy')
                            <li>
                                <a href="{{ route('pessoaFisica.index') }}">Pessoa Física</a>
                            </li>
                            @endpermission

                            @permission('pessoa.juridica.select|pessoa.juridica.store|pessoa.juridica.update|pessoa.juridica.destroy')
                            <li>
                                <a href="{{ route('pessoaJuridica.index') }}">Pessoa Jurídica</a>
                            </li>
                            @endpermission
                        </ul>
                    </li>

                    @permission('servidor.select|servidor.store|servidor.update|servidor.destroy')
                        <li>
                            <a href="{{ route('servidor.index')  }}">Servidores</a>
                        </li>
                    @endpermission

                    @permission('cargo.select|cargo.store|cargo.update|cargo.destroy')
                    <li>
                        <a href="{{ route('cargo.index')  }}"> Cargos</a>
                    </li>
                    @endpermission

                    @permission('funcao.select|funcao.store|funcao.update|funcao.destroy')
                    <li>
                        <a href="{{ route('funcao.index')  }}">Funções</a>
                    </li>
                    @endpermission
                </ul>

                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-shield-security"></i>Segurança</a>
                <ul>
                    @permission('user.select|user.store|user.update|user.destroy')
                        <li>
                            <a href="{{ route('user.index')  }}">Usuários</a>
                        </li>
                    @endpermission
                    @permission('role.select|role.store|role.update|role.destroy')
                        <li>
                            <a href="{{ route('role.index')  }}">Perfís</a>
                        </li>
                    @endpermission

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


@include('modal.modal_selecionar_escola')
@include('modal.modal_loading_ajax')

<!-- Javascript Libraries -->
<script src="{{ asset('/lib/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('/lib/Waves/dist/waves.min.js') }}"></script>
{{--<script src="{{ asset('/dist/js/bootstrap-growl/bootstrap-growl.min.js') }}"></script>--}}
<script src="{{ asset('/lib/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/lib/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('/js/plugins/botao/materialize.min.js')  }}"></script>
<script src="{{ asset('/js/webcam.js')  }}"></script>

<!-- Datepicker e suas dependencias. Sempre importa-lo nessa ordem -->
<script src="{{ asset('/lib/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('/lib/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('/lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

{{--jquery Validator https://jqueryvalidation.org/ --}}
<script src="{{ asset('/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('/lib/jquery-validation/src/additional/cpfBR.js') }}"></script>
<script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/unique.js')  }}"></script>
<script src="{{ asset('/dist/js/fileinput/fileinput.min.js')}}"></script>

{{-- Mascaras https://igorescobar.github.io/jQuery-Mask-Plugin/ --}}
<script src="{{ asset('/lib/jquery-mask-plugin/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('/dist/js/mascaras.js') }}"></script>

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

    $('#img-loading-ajax').modal({'show': false});

    @if(!Session::has('escola'))
        $('#modal-escolas').modal({'show': true});
    @endif

    $(document).on('click', '#trocar-escola', function(){
        $('#modal-escolas').modal({'show': false});
        $('#modal-escolas').modal({'show': true});
    });

</script>

@yield('javascript')

</body>
</html>