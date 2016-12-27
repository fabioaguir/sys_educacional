<!-- Modal de cadastro das Disciplinas-->
<div id="modal-procedimentos-create" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Cadastro do Procedimento</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class=" fg-line">
                                    <label for="periodo_avaliacao_id">Período Avaliação</label>
                                    <div class="select">
                                        {!! Form::select("periodo_avaliacao_id", [], null, array('class'=> 'form-control', 'id' => 'periodo_avaliacao_id')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class=" fg-line">
                                    <label for="forma_avaliacao_id">Forma Avaliação</label>
                                    <div class="select">
                                        {!! Form::select("forma_avaliacao_id", [], null, array('class'=> 'form-control', 'id' => 'forma_avaliacao_id')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Aparecer no boletim:</label>
                                <div class="form-group">
                                    <label for="status" class="checkbox checkbox-inline m-r-20">
                                        {!! Form::hidden('aparecer_boletim', 0) !!}
                                        {!! Form::checkbox('aparecer_boletim', 1, null, ['id' => 'aparecer_boletim']) !!}
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnSaveProcedimento">Salvar</button>
                <button class="btn btn-default" data-dismiss="modal" id="btnCancelarProcedimento">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro das Disciplinas-->