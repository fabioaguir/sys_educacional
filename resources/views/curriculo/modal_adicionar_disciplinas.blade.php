<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-disciplinas" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar disciplinas ao currículo</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="cCodigo"></p></span>
                                </div>

                                <div class="col-md-2">
                                    <span><strong>Nome: </strong><p id="cNome"></p></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select id="select-disciplinas" multiple class="form-control"></select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" id="addDisciplina" type="button">Adicionar</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 2%;">
                    <div class="col-md-12">
                        <table id="disciplina-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th style="width: 5%;">Acão</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro das Disciplinas-->
