<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-concelho" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Concelho Pedagógico</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="cCodigo"></p></span>
                                </div>

                                <div class="col-md-6">
                                    <span><strong>Nome: </strong><p id="cNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 2%;">

                    <!-- Gerendiamento das relações -->
                    <div class="col-md-12">
                        <!-- Adicionar Relações -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <div class=" fg-line">
                                            <label for="periodo">Período *</label>
                                            {!! Form::select("periodo", array(), null, array('class'=> 'form-control', 'id' => 'periodo')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class=" fg-line">
                                            <label for="dificuldades">Dificuldades de Aprenndizagem</label>
                                            <div class="textarea">
                                                {!! Form::textarea('dificuldades', Session::getOldInput('dificuldades'),
                                                    array('id' => 'dificuldades', 'class' => 'form-control', 'rows' => '3')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class=" fg-line">
                                            <label for="orientacoes">Orientações do concelho</label>
                                            <div class="textarea">
                                                {!! Form::textarea('orientacoes', Session::getOldInput('orientacoes'),
                                                    array('id' => 'orientacoes', 'class' => 'form-control', 'rows' => '3')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="fg-line" style="margin-top: 5px">
                                        <button type="button" id="addConcelho" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        <button type="button" id="edtConcelho" class="btn btn-success btn-sm m-t-10">Editar</button>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Fim Adicionar relacoes -->

                        <!-- Table de relacoes -->
                        <div class="table-responsive" style="margin-top: -20px">
                            <table id="concelho-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Período</th>
                                    <th>Dificuldades de Aprenndizagem</th>
                                    <th>Orientações do concelho</th>
                                    <th style="width: 12%;">Acão</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de relacoes -->
                    </div>
                    <!-- Fim do Gerendiamento dos relacoes -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos relacoes-->
