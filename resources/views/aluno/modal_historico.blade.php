<!-- Modal de cadastro das Disciplinas-->
<div id="modal-historico-aluno" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Histórico</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Nome: </strong><p id="hNome"></p></span>
                                </div>

                                <div class="col-md-6">
                                    <span><strong>Código: </strong><p id="hCodigo"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Gerendiamento dos alunos -->
                    <div class="col-md-12">
                        <!-- Table de Alocações -->
                        <div class="table-responsive">
                            <table id="historico-aluno-grid" class="display table table-bordered compact" cellspacing="0"
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
                                    <th>Situacao</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de alocações -->
                    </div>
                    <!-- Fim do Gerendiamento dos alunos -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro de alunos-->
