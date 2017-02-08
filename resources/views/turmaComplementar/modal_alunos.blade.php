<!-- Modal de cadastro das Disciplinas-->
<div id="modal-alunos" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Alunos</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="alCodigo"></p></span>
                                </div>

                                <div class="col-md-6">
                                    <span><strong>Nome: </strong><p id="alNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Gerendiamento dos alunos -->
                    <div class="col-md-12">
                        <!-- campos de descrição das vagas da turma -->
                        <div class="row" style="margin-bottom: 2%;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="numMaxVagas" class="label-control">Nº máximo de vagas</label>
                                        <input type="text" id="numMaxVagas" class="form-control" disabled>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="numVagas">Alunos matriculados</label>
                                        <input type="text" id="numVagas" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Adicionar aluno -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        <select id="select-alunos" class="form-control"></select>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary" id="addAluno" type="button">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar aluno -->

                        <!-- Table de alunos -->
                        <div class="table-responsive">
                            <table id="alunos-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Matrícula</th>
                                    <th>Nome</th>
                                    <th style="width: 5%;">Ação</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de alunos -->
                    </div>
                    <!-- Fim do Gerendiamento dos alunos -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro de alunos-->
