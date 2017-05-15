<div class="block-header">
    <h2>Matrículas</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">

                <!-- Painel -->
                <div role="tabpanel">

                    <!-- Guias -->
                    <ul id="tabs" class="tab-nav" role="tablist" data-tab-color="cyan">
                        <li class="active"><a href="#matricula" aria-controls="matricula" role="tab" data-toggle="tab">Matrícula</a>
                        </li>
                        <li><a href="#alunos" aria-controls="alunos" role="tab" data-toggle="tab">Alunos</a>
                        </li>
                    </ul>
                    <!-- Fim Guias -->

                    <!-- Conteúdo -->
                    <div class="tab-content">

                        {{--#1--}}
                        <div role="tabpanel" class="tab-pane active" id="matricula">
                            <br/>
                            {{--# row 1--}}
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class=" fg-line">
                                        <label for="turma">Turma *</label>
                                        <div class="select">
                                            {!! Form::select("turma", array(), null, array('class'=> 'form-control input-sm', 'id' => 'turma')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="data_matricula">Data de matrícula *</label>
                                            {!! Form::text('data_matricula', null, array('class' => 'form-control input-sm campo', 'id' => 'data_matricula')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="calendario">Calendário</label>
                                            {!! Form::text('calendario', null, array('class' => 'form-control input-sm campo', 'id' => 'calendario', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--# row 2--}}
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="curso">Curso</label>
                                            {!! Form::text('curso', null, array('class' => 'form-control input-sm campo', 'id' => 'curso', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="serie">Série/Ano</label>
                                            {!! Form::text('serie', null, array('class' => 'form-control input-sm campo', 'id' => 'serie', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="turno">Turno</label>
                                            {!! Form::text('turno', null, array('class' => 'form-control input-sm campo', 'id' => 'turno', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--# row 3--}}
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="vagas">Vagas</label>
                                            {!! Form::text('vagas', null, array('class' => 'form-control input-sm campo', 'id' => 'vagas', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="alunos_matriculados">Aluno matriculados</label>
                                            {!! Form::text('alunos_matriculados', null, array('class' => 'form-control input-sm campo', 'id' => 'alunos_matriculados', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="vagas_disponiveis">Vagas disponíveis</label>
                                            {!! Form::text('vagas_disponiveis', null, array('class' => 'form-control input-sm campo', 'id' => 'vagas_disponiveis', 'disabled' => 'disabled')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--# row 4--}}
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <div class=" fg-line">
                                        <label for="source">Alunos em condição de matrícula</label>
                                        <select multiple class="form-control" id="source">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class=" fg-line">
                                        <button id='btnAllRight' class="btn btn-primary btn-sm m-t-10">>></button>
                                        <button id='btnRight' class="btn btn-primary btn-sm m-t-10">></button>
                                        <button id='btnLeft' class="btn btn-primary btn-sm m-t-10"><</button>
                                        <button id='btnAllLeft' class="btn btn-primary btn-sm m-t-10"><<</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <div class=" fg-line">
                                        <label for="destination">Matricular na turma <span id="nome-turma"></span></label>
                                        <select multiple class="form-control" name="destination" id="destination">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="addAlunoTurma" class="btn btn-primary btn-sm m-t-10">Salvar</button>
                            {{--<a class="btn btn-primary btn-sm m-t-10" href="{{ route('cargo.index') }}">Voltar</a>--}}

                        </div>

                        {{--#2--}}
                        <div role="tabpanel" class="tab-pane" id="alunos">
                            <br />

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Table de Alocações -->
                                    <div class="table-responsive">
                                        <table id="aluno-turmas-grid" class="display table table-bordered compact" cellspacing="0"
                                               width="100%">
                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Turma Anterior</th>
                                                <th>Data Matrícula</th>
                                                <th>Data Saída</th>
                                                <th>Matrícula</th>
                                                <th style="width: 8%;">Acão</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <!-- Fim Table de alocações -->
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/cargos.js')  }}"></script>

    <script type="text/javascript" src="{{ asset('/dist/js/jquery.selectlistactions.js')  }}"></script>

    <script type="text/javascript" src="{{ asset('/dist/matricular/loadFields.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('/dist/matricular/modal_controller_aluno_turma.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/dist/matricular/modal_adicionar_aluno_turma.js') }}"></script>
    <script type="text/javascript">

        $('#btnRight').click(function (e) {
            $('select').moveToListAndDelete('#source', '#destination');
            e.preventDefault();
        });

        $('#btnAllRight').click(function (e) {
            $('select').moveAllToListAndDelete('#source', '#destination');
            e.preventDefault();
        });

        $('#btnLeft').click(function (e) {
            $('select').moveToListAndDelete('#destination', '#source');
            e.preventDefault();
        });

        $('#btnAllLeft').click(function (e) {
            $('select').moveAllToListAndDelete('#destination', '#source');
            e.preventDefault();
        });

    </script>
@endsection