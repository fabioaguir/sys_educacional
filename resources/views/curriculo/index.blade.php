@extends('menu')

@section('css')
    @parent
    <style type="text/css">
        .select2-container {
            width: 100% !important;
            padding: 0;
        }

        .select2-close-mask{
            z-index: 2099;
        }

        .select2-dropdown{
            z-index: 3051;
        }
    </style>
@endsection

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Currículos</h2>
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
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('curriculo.create') }}">Novo Currículo</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="curriculo-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Curso</th>
                                <th>Ativo</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Codigo</th>
                                <th>Curso</th>
                                <th>Ativo</th>
                                <th style="width: 15%;">Açao</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>

    @include('curriculo.modal_adicionar_disciplinas')
@stop

@section('javascript')
    @parent
    <script type="text/javascript" src="{{ asset('/dist/curriculo/modal_adicionar_disciplinas.js') }}"></script>
    <script type="text/javascript">
        var table = $('#curriculo-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('curriculo.grid') }}",
            columns: [
                {data: 'nome', name: 'curriculos.nome'},
                {data: 'codigo', name: 'curriculos.codigo'},
                {data: 'codigo_curso', name: 'cursos.codigo'},
                {data: 'ativo', name: 'curriculos.ativo'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ]
        });

        // Global IdCurriulo
        var idCurriculo;

        // Evento para abrir o modal de cursos/turmas
        $(document).on("click", "#btnModalAdicionarDisciplinas", function () {
            // Recuperando o id do currículo
            idCurriculo = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e o código
            var codigo = table.row($(this).parents('tr')).data().codigo;
            var nome   = table.row($(this).parents('tr')).data().nome;

            // prenchendo o titulo do nome do aluno
            $('#cNome').text(codigo);
            $('#cCodigo').text(nome);

            // Executando o modal
            runModalAdicionarDisciplinas(idCurriculo);
        });
    </script>
@stop