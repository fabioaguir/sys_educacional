@extends('menu')

@section('css')
    <style>
        table#dados-turma tbody tr, table#dados-turma  thead tr {
            font-size: 11px;
        }
    </style>
@endsection

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Alunos</h2>
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
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('aluno.create') }}">Novo Aluno</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="aluno-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Data de Nascimento</th>
                                <th>Nome da Mãe</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Data de Nascimento</th>
                                <th>Nome da Mãe</th>
                                <th>Açao</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>

    @include('aluno.modal_adicionar_aluno_turma')
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/loadFields.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/modal_adicionar_aluno_turma.js') }}"></script>
    <script type="text/javascript">
        var table = $('#aluno-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('aluno.grid') }}",
            columns: [
                {data: 'nome', name: 'cgm.nome'},
                {data: 'codigo', name: 'alunos.codigo'},
                {data: 'data_nascimento', name: 'cgm.data_nascimento'},
                {data: 'mae', name: 'cgm.mae'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        //Global idAluno
        var idAluno;

        // Evento para abrir o modal de matrícula
        $(document).on("click", "#btnModalAdicionarAlunoTurma", function () {
            // Recuperando o id do calendário
            idAluno = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var nome = table.row($(this).parents('tr')).data().nome;
            var codigo   = table.row($(this).parents('tr')).data().codigo;

            // prenchendo o titulo do nome do aluno
            $('#aNome').text(nome);
            $('#aCodigo').text(codigo);

            // Executando o modal
            runModalAdicionarAlunosTurmas(idAluno);
        });

    </script>
@stop