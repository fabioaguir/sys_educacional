@extends('menu')

@section('css')
    @parent
    <style type="text/css">
        .select2-close-mask{
            z-index: 2099;
        }

        .select2-dropdown{
            z-index: 3051;
        }

        .row_selected {
            background-color: #6A5ACD !important;
            color: #FFF;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Escolas</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <em> {!! session('message') !!}</em>
                        </div>
                    @endif

                    @if(Session::has('errors'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif


                                <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('escola.create') }}">Nova Escola</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="escola-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Abreviação</th>
                                <th>Coordenadoria</th>
                                <th>Mantenedora</th>
                                <th style="width: 15%;">Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Abreviação</th>
                                <th>Coordenadoria</th>
                                <th>Mantenedora</th>
                                <th style="width: 15%;">Açao</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>

    @include('escola.modal_adicionar_cursos')
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/escola/modal_adicionar_cursos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/escola/controller_cursos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/escola/controller_turnos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/escola/select2.js') }}"></script>
    <script type="text/javascript">
        var table = $('#escola-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: laroute.route('escola.grid'),
            columns: [
                {data: 'codigo', name: 'escola.codigo'},
                {data: 'nome', name: 'escola.nome'},
                {data: 'nome_abreviado', name: 'escola.nome_abreviado'},
                {data: 'coordenadoria', name: 'coordenadoria.nome'},
                {data: 'mantenedora', name: 'mantenedora.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]});

        // Global IdCurriulo
        var idEscola;

        // Evento para abrir o modal de cursos/turmas
        $(document).on("click", "#btnModalAdicionarCursos", function () {
            // Recuperando o id do currículo
            idEscola = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do modal
            $('#eNome').text(nome);

            // Executando o modal
            runModalAdicionarCursos(idEscola);
        });
    </script>
@stop