<!-- Modal de cadastro das Alocações-->
<div id="modal-adicionar-aluno-turma" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Matricular Aluno</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" style="background-color: #e6e9dc">
                                <div class="col-md-4" style="margin-top: 17px">
                                    <span><strong>Nome: </strong><p id="aNome"></p></span>
                                </div>

                                <div class="col-md-2" style="margin-top: 17px">
                                    <span><strong>Código: </strong><p id="aCodigo"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 2%;">

                    <!-- Gerendiamento dos Alocações -->
                    <div class="col-md-12">
                        <!-- Adicionar Alocações -->
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group col-md-2">
                                    <div class=" fg-line">
                                        <label for="turma">Turma *</label>
                                        <div class="select">
                                            {!! Form::select("turma", array(), null, array('class'=> 'form-control', 'id' => 'turma')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="serie-historico">Série</label>
                                        <input type="text" class="form-control" id="serie-historico" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="turno-historico">Turno</label>
                                        <input type="text" class="form-control" id="turno-historico" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="vagas-historico">Vagas</label>
                                        <input type="text" class="form-control" id="vagas-historico" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="matriculados-historico">Alunos Matriculados</label>
                                        <input type="text" class="form-control" id="matriculados-historico" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="vagas-restantes-historico">Vagas restantes</label>
                                        <input type="text" class="form-control" id="vagas-restantes-historico" readonly>
                                    </div>
                                </div>

                                {{--<div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <label for="data">Data da matrícula *</label>
                                        {!! Form::text('data', null, array('class' => 'form-control input-sm date-picker', 'id' => 'data', 'placeholder' => 'Data da matrícula')) !!}
                                    </div>
                                </div>--}}

                                <div class="form-group col-md-2">
                                    <div class="fg-line" style="margin-top: 10px">
                                        <button type="button" id="addAlunoTurma" class="btn btn-primary btn-sm m-t-10">Matricular</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Fim Adicionar Alocações -->
                    </div>
                    <div class="col-md-12">
                        <!-- Table de Alocações -->
                        <div class="table-responsive">
                            <table id="aluno-turmas-grid" class="display table table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Data</th>
                                    <th>Turma</th>
                                    <th>Escola</th>
                                    <th>Curso</th>
                                    <th>Base Curricular</th>
                                    <th>Calendário</th>
                                    <th>Série/Ano</th>
                                    <th>Turno</th>
                                    <th style="width: 8%;">Acão</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de alocações -->
                    </div>
                    <!-- Fim do Gerendiamento dos alocações -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos alocações-->
