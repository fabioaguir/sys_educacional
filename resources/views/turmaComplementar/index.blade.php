@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Turmas Complementares</h2>
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

                    @permission('turma.complementar.store')
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('turmaComplementar.create') }}">Nova Turma Complementar</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
                </div>

                <div class="table-responsive">
                    <table id="turmaComplementar-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Escola</th>
                                <th>Turno</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Escola</th>
                                <th>Turno</th>
                                <th style="width: 15%;">Açao</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('turmaComplementar.modal_atividades')
    @include('turmaComplementar.modal_alunos')
@stop

@section('javascript')
    @parent
    <script type="text/javascript" src="{{ asset('/dist/turmaComplementar/modal_atividades.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turmaComplementar/modal_alunos.js') }}"></script>
    <script type="text/javascript">
        var table = $('#turmaComplementar-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('turmaComplementar.grid') }}",
            columns: [
                {data: 'nome', name: 'edu_turmas.nome'},
                {data: 'codigo', name: 'edu_turmas.codigo'},
                {data: 'escola', name: 'edu_escola.codigo'},
                {data: 'turno', name: 'edu_turnos.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Global idTurmaComplementar
        var idTurmaComplementar;

        // Evento para abrir o modal de atividades
        $(document).on("click", "#btnModalAtividades", function () {
            // Recuperando o id da atividade
            idTurmaComplementar = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do modal de atividades
            $('#aNome').text(nome);
            $('#aCodigo').text(codigo);

            // Executando o modal
            runModalAtividades(idTurmaComplementar);
        });

        // Evento para abrir o modal de alunos
        $(document).on("click", "#btnModalAlunos", function () {
            // Recuperando o id da turma
            idTurmaComplementar = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;
            var vagas  = table.row($(this).parents('tr')).data().vagas;

            // prenchendo o titulo do nome do aluno
            $('#alNome').text(nome);
            $('#alCodigo').text(codigo);
            $('#numMaxVagas').val(vagas);
            numAlunosMatriculados();

            // Executando o modal
            runModalAluno(idTurmaComplementar);
        });
    </script>
@stop