<!-- Modal de cadastro das Alocações-->
<div id="modal-mudanca-turma" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Mudança de turma</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" style="background-color: #e6e9dc">
                                <div class="col-md-4" style="margin-top: 17px">
                                    <span><strong>Nome: </strong><p id="tNome"></p></span>
                                </div>

                                <div class="col-md-2" style="margin-top: 17px">
                                    <span><strong>Código: </strong><p id="tCodigo"></p></span>
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
                                        <label for="turma_mudanca">Turma *</label>
                                        <div class="select">
                                            {!! Form::select("turma_mudanca", array(), null, array('class'=> 'form-control', 'id' => 'turma_mudanca')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="turno-historico">Turno</label>
                                        <input type="text" class="form-control" id="turno-mudanca-turma" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="vagas-historico">Vagas</label>
                                        <input type="text" class="form-control" id="vagas-mudanca-turma" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="matriculados-historico">Alunos Matriculados</label>
                                        <input type="text" class="form-control" id="matriculados-mudanca-turma" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="vagas-restantes-historico">Vagas restantes</label>
                                        <input type="text" class="form-control" id="vagas-restantes-mudanca-turma" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line" style="margin-top: 10px">
                                        <button type="button" id="mudarTurma" class="btn btn-primary btn-sm m-t-10">Mudar Turma</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Fim Adicionar Alocações -->
                    </div>
                    <!-- Fim do Gerendiamento dos alocações -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos alocações-->
