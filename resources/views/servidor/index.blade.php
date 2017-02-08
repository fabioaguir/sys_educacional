@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Servidores</h2>
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

                    @permission('servidor.store')
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('servidor.create') }}">Novo Servidor</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
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
    @include('servidor.modal_adicionar_disponibilidade')
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_controller_servidor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_telefones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_relacao_trabalho.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_formacao.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_atividade.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_alocacao.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_adicionar_disponibilidade.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/loadFields.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/servidor/loadFieldsDisponibilidade.js') }}"></script>
    <script type="text/javascript">
        var table = $('#servidor-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route ('servidor.grid') }}",
            columns: [
                {data: 'nome', name: 'cgm.nome'},
                {data: 'matricula', name: 'servidor.matricula'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });

        // Máscaras
        $(document).ready(function() {
            $('#numero').mask('(00) 00000-0000');
        });
    </script>
@stop