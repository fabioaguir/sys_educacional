@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Consultar Períodos Avaliativos</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('periodoAvaliacao.create') }}">Novo Período</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="periodoAvaliacao-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>RG</th>
                                <th>CPF</th>
                                <th>CPF</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>RG</th>
                                <th>CPF</th>
                                <th>CPF</th>
                                <th>Açao</th>
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
        var table = $('#periodoAvaliacao-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: laroute.route('periodoAvaliacao.grid'),
            columns: [
                {data: 'data_inicial', name: 'periodos_avaliacao.data_inicial'},
                {data: 'data_final',  name: 'periodos_avaliacao.data_final'},
                {data: 'periodo',     name: 'periodos.periodo'},
                {data: 'calendario',  name: 'calendarios.calendario'},
                {data: 'action',      name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@stop