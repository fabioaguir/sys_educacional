@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Perfís</h2>
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

                    @permission('role.store')
                    <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('role.create') }}">Novo Perfil</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                    @endpermission
                </div>

                <div class="table-responsive">
                    <table id="role-grid" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Açao</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th style="width: 10%;">Açao</th>
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
        var table = $('#role-grid').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('role.grid') }}",
            columns: [
                {data: 'name', name: 'roles.name'},
                {data: 'description', name: 'roles.description'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@stop