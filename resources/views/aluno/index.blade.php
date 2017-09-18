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

                    @permission('aluno.store')
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('aluno.create') }}">Novo Aluno</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="aluno-grid" class="table table-hover compact">
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Relatórios de Alunos
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <select class="form-control" id="report_id" name="relatorios">
                                                        <option value="">Selecione um relatório</option>
                                                        <option value="1">Fixa do aluno</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    @include('aluno.modal_adicionar_aluno_turma')
    @include('aluno.modal_historico')
    @include('aluno.modal_mudanca_turma')
    @include('relatorios.alunos.modals.modal_report_fixa_do_aluno')
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/loadFields.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/modal_controller_aluno_turma.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/modal_adicionar_aluno_turma.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/modal_historico_aluno.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/alunoTurma/modal_mudanca_turma.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/dist/relatorios/alunos/chamar_relatorios.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/relatorios/alunos/loadFields.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/relatorios/alunos/modal_fixa_do_aluno.js') }}"></script>

    <script type="text/javascript">
        var table = $('#aluno-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('aluno.grid') }}",
            columns: [
                {data: 'nome', name: 'gen_cgm.nome'},
                {data: 'codigo', name: 'edu_alunos.codigo'},
                {data: 'data_nascimento', name: 'gen_cgm.data_nascimento'},
                {data: 'mae', name: 'gen_cgm.mae'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // Geriamento dos relatórios avançadas
        $(document).on('change', '#report_id', function () {
            // Recuperando o id do relatório
            var reportId = $('#report_id').val();

            // Validando o id do relatório
            if(!reportId) {
                return false;
            }

            // Chama o modal do relatórios correspondente
            chamarRelatorio(reportId);

        });

    </script>
@stop