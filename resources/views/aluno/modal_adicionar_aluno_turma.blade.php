<!-- Modal de cadastro das Alocações-->
<div id="modal-adicionar-aluno-turma" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Aluno em turma</h4>
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
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="col-md-6">
                                <div class="form-group col-md-6">
                                    <div class=" fg-line">
                                        <label for="turma">Turma *</label>
                                        <div class="select">
                                            {!! Form::select("turma", array(), null, array('class'=> 'form-control', 'id' => 'turma')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="data">Data da matrícula *</label>
                                            {!! Form::text('data', null, array('class' => 'form-control input-sm date-picker', 'id' => 'data', 'placeholder' => 'Data da matrícula')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line" style="margin-top: 20px">
                                        <div class="fg-line">
                                            <button type="button" id="addAlunoTurma" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Alocações -->
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="dados-turma" class=" table table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr style="background-color: #f1f3f2">
                                    <th>Escola</th>
                                    <th>Curso</th>
                                    <th>Base curricular</th>
                                    <th>Calendário</th>
                                    <th>Série/Ano</th>
                                    <th>Turno</th>
                                    <th>Vagas</th>
                                    <th>Aluno Matriculados</th>
                                    <th>Vagas restantes</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Table de Alocações -->
                        <div class="table-responsive">
                            <table id="aluno-turmas-grid" class="display table table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Matrícula</th>
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
