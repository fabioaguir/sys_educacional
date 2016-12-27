<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-cursos" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar cursos a escola</h4>
            </div>

            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;"">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <span><strong>Nome: </strong><p id="eNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 2%;">
                    <!-- Grid das Séries -->
                    <div class="col-md-4">
                        <!-- Adicionar Turnos -->
                        <div class="row" style="margin-top: -5%; margin-bottom: 3%;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select id="select-cursos" multiple class="form-control"></select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" id="addCurso" type="button">Adicionar</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Turnos -->

                        <table id="cursos-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Curso</th>
                                <th style="width: 5%;">Acão</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Fim grid das séries -->

                    <!-- Gerendiamento das Disciplinas da Séries -->
                    <div class="col-md-8">
                        <!-- Adicionar Turnos -->
                        <div class="row" style="margin-top: -2.5%; margin-bottom: 2.5%;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select id="select-turnos" multiple class="form-control"></select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" id="addTurno" type="button">Adicionar</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Turnos -->

                        <!-- Table de disciplinas -->
                        <table id="turnos-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th style="width: 5%;">Acão</th>
                            </tr>
                            </thead>
                        </table>
                        <!-- Fim Table de disciplinas -->
                    </div>
                    <!-- Fim do Gerendiamento das Disciplinas da Séries -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro das Disciplinas-->
