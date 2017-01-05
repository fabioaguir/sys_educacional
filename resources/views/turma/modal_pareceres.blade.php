<!-- Modal de cadastro das Disciplinas-->
<div id="modal-pareceres" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Pareceres</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="paCodigo"></p></span>
                                </div>

                                <div class="col-md-6">
                                    <span><strong>Nome: </strong><p id="paNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Gerendiamento de pareceres -->
                    <div class="col-md-12">
                        <!-- Adicionar Parecer -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        <select id="select-pareceres" multiple class="form-control"></select>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary" id="addParecer" type="button">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Parecer -->

                        <!-- Table de pareceres -->
                        <div class="table-responsive">
                            <table id="pareceres-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">Código</th>
                                    <th>Nome</th>
                                    <th style="width: 5%;">Ação</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de pareceres -->
                    </div>
                    <!-- Fim do Gerendiamento dos pareceres -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro de pareceres-->
