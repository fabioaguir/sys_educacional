@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Consultar CGM - Pessoa Jurídica</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">

                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('create') }}">Nova pessoa jurídica</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="pessoaJuridica-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>RG</th>
                                <th>CNPJ</th>
                                <th>CGM do Município</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>RG</th>
                                <th>CNPJ</th>
                                <th>CGM do Município</th>
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
        var table = $('#pessoaJuridica-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: laroute.route('pessoaJuridica.grid'),
            columns: [

                {data: 'nome', name: 'cgm.nome'},
                {data: 'rg', name: 'cgm.rg'},
                {data: 'cnpj', name: 'cgm.cnpj'},
                {data: 'statusCgm', name: 'cgm_municipio.nome'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
            /*"oLanguage": {
                "sStripClasses": "",
                "sSearch": "",
                "sSearchPlaceholder": "Enter Keywords Here",
                "sInfo": "_START_ - _END_ de _TOTAL_",
                "sLengthMenu": '<span>Linhas por Página:</span><select class="browser-default">' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">All</option>' +
                '</select></div>'
            }*/
        });
    </script>
@stop
