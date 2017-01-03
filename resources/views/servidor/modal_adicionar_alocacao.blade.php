<!-- Modal de cadastro das Alocações-->
<div id="modal-adicionar-alocacoes" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Alocações</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" style="background-color: #e6e9dc">
                                <div class="col-md-4" style="margin-top: 17px">
                                    <span><strong>Nome: </strong><p class="sNome"></p></span>
                                </div>

                                <div class="col-md-2" style="margin-top: 17px">
                                    <span><strong>Matrícula: </strong><p class="sMatricula"></p></span>
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
                            <div class="form-group col-md-8">
                                <div class=" fg-line">
                                    <label for="escola">Escola *</label>
                                    <div class="select">
                                        {!! Form::select("escola", array(), null, array('class'=> 'form-control', 'id' => 'escola')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="fg-line" style="margin-top: 20px">
                                    <div class="fg-line">
                                        <button type="button" id="addAlocacao" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Alocações -->

                        <!-- Table de Alocações -->
                        <table id="alocacoes-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Escola</th>
                                <th style="width: 8%;">Acão</th>
                            </tr>
                            </thead>
                        </table>
                        <!-- Fim Table de alocações -->
                    </div>
                    <!-- Fim do Gerendiamento dos alocações -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos alocações-->
