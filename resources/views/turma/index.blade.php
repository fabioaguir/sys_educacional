@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Turmas</h2>
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

                   @permission('turma.store')
                   <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('turma.create') }}">Nova Turma</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
                </div>

                <div class="table-responsive">
                    <table id="turma-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Escola</th>
                                <th>Curso</th>
                                <th>Currículo</th>
                                <th>Turno</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Escola</th>
                                <th>Curso</th>
                                <th>Currículo</th>
                                <th>Turno</th>
                                <th style="width: 15%;">Açao</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('turma.modal_disciplinas')
    @include('turma.modal_alunos')
    @include('turma.modal_pareceres')
    @include('turma.modal_horarios')
@stop

@section('javascript')
    @parent
    <script type="text/javascript" src="{{ asset('/dist/turma/modal_disciplinas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turma/modal_alunos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turma/modal_pareceres.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turma/modal_horarios.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turma/loadFieldsHorarios.js') }}"></script>
    <script type="text/javascript">
        var table = $('#turma-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('turma.grid') }}",
            columns: [
                {data: 'nome', name: 'edu_turmas.nome'},
                {data: 'codigo', name: 'edu_turmas.codigo'},
                {data: 'escola', name: 'edu_escola.codigo'},
                {data: 'curso', name: 'edu_cursos.codigo'},
                {data: 'curriculo', name: 'edu_curriculos.codigo'},
                {data: 'turno', name: 'edu_turnos.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Global idTurma
        var idTurma, idEscola, idSerie, idTurno;

        // Evento para abrir o modal de cursos/turmas
        $(document).on("click", "#btnModalDisciplinas", function () {
            // Recuperando o id do currículo
            idTurma = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do nome do aluno
            $('#dNome').text(nome);
            $('#dCodigo').text(codigo);

            // Executando o modal
            runModalDisciplinas(idTurma);
        });

        // Evento para abrir o modal de alunos/turmas
        $(document).on("click", "#btnModalAlunos", function () {
            // Recuperando o id do currículo
            idTurma = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do nome do aluno
            $('#alNome').text(nome);
            $('#alCodigo').text(codigo);

            // Executando o modal
            runModalAluno(idTurma);
        });

        // Evento para abrir o modal de pareceres
        $(document).on("click", "#btnModalPareceres", function () {
            // Recuperando o id do currículo
            idTurma = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do nome do aluno
            $('#paNome').text(nome);
            $('#paCodigo').text(codigo);

            // Executando o modal
            runModalParecer(idTurma);
        });

        // Evento para abrir o modal de horários
        $(document).on("click", "#btnModalHorarios", function () {
            // Recuperando o id do turma
            idTurma = table.row($(this).parents('tr')).data().id;
            idEscola = table.row($(this).parents('tr')).data().escola_id;
            idSerie = table.row($(this).parents('tr')).data().serie_id;
            idTurno = table.row($(this).parents('tr')).data().turno_id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do nome do aluno
            $('#hoNome').text(nome);
            $('#hoCodigo').text(codigo);

            // Executando o modal
            runModalHorarios(idTurma, idEscola, idSerie, idTurno);
        });
    </script>
@stop