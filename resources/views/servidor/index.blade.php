@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Servidores</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">

                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('servidor.create') }}">Novo Servidor</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="servidor-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Matrícula</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Matrícula</th>
                                <th style="width: 12%;">Açao</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('servidor.modal_adicionar_telefones')
    @include('servidor.modal_adicionar_relacao_trabalho')
    @include('servidor.modal_adicionar_formacao')
    @include('servidor.modal_adicionar_atividade')
    @include('servidor.modal_adicionar_alocacao')
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_telefones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_relacao_trabalho.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_formacao.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_atividade.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_alocacao.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/loadFields.js') }}"></script>
    <script type="text/javascript">
        var table = $('#servidor-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: laroute.route('servidor.grid'),
            columns: [
                {data: 'nome', name: 'cgm.nome'},
                {data: 'matricula', name: 'servidor.matricula'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });

        //Global idCgm, idServidor
        var idCgm, idServidor;

        // Evento para abrir o modal de telefones
        $(document).on("click", "#btnModalAdicionarTelefone", function () {
            // Recuperando o id do cgm
            idCgm = table.row($(this).parents('tr')).data().cgm_id;

            // Recuperando o nome e matrícula
            var nome = table.row($(this).parents('tr')).data().nome;
            var matricula   = table.row($(this).parents('tr')).data().matricula;

            // prenchendo o titulo do nome e matrícula do servidor
            $('#sNome').text(nome);
            $('#sMatricula').text(matricula);

            // Executando o modal
            runModalAdicionarTelefones(idCgm);
        });

        // Evento para abrir o modal de relações de trabalho
        $(document).on("click", "#btnModalAdicionarRelacao", function () {
            // Recuperando o id da relacao
            idServidor = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e matrícula
            var nome = table.row($(this).parents('tr')).data().nome;
            var matricula   = table.row($(this).parents('tr')).data().matricula;

            // prenchendo o titulo do nome e matrícula do servidor
            $('.sNome').text(nome);
            $('.sMatricula').text(matricula);

            // Executando o modal
            runModalAdicionarRelacoes(idServidor);
        });

        // Evento para abrir o modal de formações
        $(document).on("click", "#btnModalAdicionarFormacao", function () {
            // Recuperando o id da formação
            idServidor = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e matrícula
            var nome = table.row($(this).parents('tr')).data().nome;
            var matricula   = table.row($(this).parents('tr')).data().matricula;

            // prenchendo o titulo do nome e matrícula do servidor
            $('.sNome').text(nome);
            $('.sMatricula').text(matricula);

            // Executando o modal
            runModalAdicionarFormacoes(idServidor);
        });

        // Evento para abrir o modal de formações
        $(document).on("click", "#btnModalAdicionarAtividade", function () {
            // Recuperando o id da formação
            idServidor = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e matrícula
            var nome = table.row($(this).parents('tr')).data().nome;
            var matricula   = table.row($(this).parents('tr')).data().matricula;

            // prenchendo o titulo do nome e matrícula do servidor
            $('.sNome').text(nome);
            $('.sMatricula').text(matricula);

            // Executando o modal
            runModalAdicionarAtividades(idServidor);
        });

        // Evento para abrir o modal de alocações
        $(document).on("click", "#btnModalAdicionarAlocacao", function () {
            // Recuperando o id da alocação
            idServidor = table.row($(this).parents('tr')).data().id;

            // Recuperando o nome e matrícula
            var nome = table.row($(this).parents('tr')).data().nome;
            var matricula   = table.row($(this).parents('tr')).data().matricula;

            // prenchendo o titulo do nome e matrícula do servidor
            $('.sNome').text(nome);
            $('.sMatricula').text(matricula);

            // Executando o modal
            runModalAdicionarAlocacoes(idServidor);
        });

        // Máscaras
        $(document).ready(function() {
            $('#numero').mask('(00) 00000-0000');
        });
    </script>
@stop