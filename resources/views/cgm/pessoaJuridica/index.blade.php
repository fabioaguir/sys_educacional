@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Consultar CGM - Pessoa Jurídica</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">

                    @permission('pessoa.juridica.store')
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('pessoaJuridica.create') }}">Nova pessoa jurídica</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
                </div>

                <div class="table-responsive">
                    <table id="pessoaJuridica-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CNPJ</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>CNPJ</th>
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

                {data: 'nome', name: 'gen_cgm.nome'},
                {data: 'cnpj', name: 'gen_cgm.cnpj'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@stop
