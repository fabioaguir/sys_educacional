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


                     <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('turma.create') }}">Nova Turma</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
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
@stop

@section('javascript')
    @parent
    <script type="text/javascript" src="{{ asset('/dist/turma/modal_disciplinas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turma/modal_alunos.js') }}"></script>
    <script type="text/javascript">
        var table = $('#turma-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('turma.grid') }}",
            columns: [
                {data: 'nome', name: 'turmas.nome'},
                {data: 'codigo', name: 'turmas.codigo'},
                {data: 'escola', name: 'escola.codigo'},
                {data: 'curso', name: 'cursos.codigo'},
                {data: 'curriculo', name: 'curriculos.codigo'},
                {data: 'turno', name: 'turnos.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Global idTurma
        var idTurma;

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
    </script>
@stop