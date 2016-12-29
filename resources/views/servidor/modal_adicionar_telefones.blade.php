<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-telefones" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Telefones</h4>
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

                    <!-- Gerendiamento dos Telefones -->
                    <div class="col-md-12">
                        <!-- Adicionar Telefones -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="tipo_telefones_id">Tipo telefone *</label>
                                    <div class="select">
                                        {!! Form::select("tipo_telefones_id", array(), null, array('class'=> 'form-control', 'id' => 'tipoTelefone')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="numero">Número *</label>
                                        {!! Form::text('nome', null, array('class' => 'form-control input-sm', 'id' => 'numero', 'placeholder' => 'Número')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="ramal">Ramal</label>
                                        {!! Form::text('ramal', null, array('class' => 'form-control input-sm', 'id' => 'ramal', 'placeholder' => 'Ramal')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="observacao">Observação</label>
                                        {!! Form::text('observacao', null, array('class' => 'form-control input-sm', 'id' => 'observacao')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line" style="margin-top: 20px">
                                    <div class="fg-line">
                                        <button type="button" id="addTelefone" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        <button style="margin-left: 5px" type="button" id="edtTelefone" class="btn btn-success btn-sm m-t-10">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Telefones -->

                        <!-- Table de telefones -->
                        <div class="table-responsive">
                            <table id="telefones-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="width: 20%;">Número</th>
                                    <th>Tipo</th>
                                    <th>Ramal</th>
                                    <th style="width: 8%;">Acão</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de telefones -->
                    </div>
                    <!-- Fim do Gerendiamento dos telefones -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos telefones-->
