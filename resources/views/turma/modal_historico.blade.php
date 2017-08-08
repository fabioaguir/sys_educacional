<!-- Modal de cadastro dos horários -->
<div id="modal-historico" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Matrícula</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="hiCodigo"></p></span>
                                </div>

                                <div class="col-md-6">
                                    <span><strong>Nome: </strong><p id="hiNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group col-md-2">
                            <div class=" fg-line">
                                <label for="serie-historico">Série/Ano *</label>
                                {!! Form::select("serie", array(), null, array('class'=> 'form-control', 'id' => 'serie-historico')) !!}
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div class=" fg-line">
                                <label for="professor">Turma *</label>
                                {!! Form::select("turma-historico", array(), null, array('class'=> 'form-control', 'id' => 'turma-historico')) !!}
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

                    </div>

                    <div class="col-md-12">
                        <div class="form-group col-md-2">
                            <div class="fg-line" style="margin-top: 10px">
                                <button type="button" id="matricular" class="btn btn-primary btn-sm m-t-10">Matricular</button>
                            </div>
                        </div>
                    </div>

                    <!-- Gerendiamento dos horários -->
                    <div class="col-md-12">
                        <!-- Table de horários -->
                        <div class="table-responsive">
                            <table id="historico-grid" class="display table table-bordered compact" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">Matrícula</th>
                                    <th>Nome</th>
                                    <th style="width: 15%;">Data de Matrícula</th>
                                    <th style="width: 15%;">Situação</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de horários -->
                    </div>
                    <!-- Fim do Gerendiamento dos horários -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro de horários-->
