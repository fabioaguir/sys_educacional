@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Consultar Períodos</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">

                    @permission('periodo.store')
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('periodo.create') }}">Novo Período</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
                </div>

                <div class="table-responsive">
                    <table id="periodo-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Abreviatura</th>
                                <th>Soma Carga Horária</th>
                                <th>Controle Frequência</th>
                                <th>Ordenação</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Abreviatura</th>
                                <th>Soma Carga Horária</th>
                                <th>Controle Frequência</th>
                                <th>Ordenação</th>
                                <th>Ação</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>
@stop

@section('javascript')
    <script type="text/javascript">
        var table = $('#periodo-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: laroute.route('periodo.grid'),
            columns: [
                {data: 'nome',                  name: 'periodos.nome'},
                {data: 'abreviatura',           name: 'periodos.abreviatura'},
                {data: 'soma_carga_horaria',    name: 'periodos.soma_carga_horaria'},
                {data: 'controle_frequencia',  name: 'periodos.controle_frequencia'},
                {data: 'ordenacao',             name: 'periodos.ordenacao'},
                {data: 'action',                name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@stop