<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-relacoes" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Relações de Trabalho</h4>
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

                    <!-- Gerendiamento das relações -->
                    <div class="col-md-12">
                        <!-- Adicionar Relações -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="regime">Regime de trabalho *</label>
                                    <div class="select">
                                        {!! Form::select("regime", array(), null, array('class'=> 'form-control', 'id' => 'regime')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="area">Área de trabalho *</label>
                                    <div class="select">
                                        {!! Form::select("area", array(), null, array('class'=> 'form-control', 'id' => 'area')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="ensino">Ensino *</label>
                                    <div class="select">
                                        {!! Form::select("ensino", array(), null, array('class'=> 'form-control', 'id' => 'ensino')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="ensino">Disciplina *</label>
                                    <div class="select">
                                        {!! Form::select("disciplina", array(), null, array('class'=> 'form-control', 'id' => 'disciplina')) !!}
                                    </div>
                                </div>
                            </div>



                            <div class="form-group col-md-2">
                                <div class="fg-line" style="margin-top: 20px">
                                    <div class="fg-line">
                                        <button type="button" id="addRelacao" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        <button style="margin-left: 5px" type="button" id="edtRelacao" class="btn btn-success btn-sm m-t-10">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar relacoes -->

                        <!-- Table de relacoes -->
                        <table id="relacoes-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Regime</th>
                                <th>Área</th>
                                <th>Ensino</th>
                                <th>Disciplina</th>
                                <th style="width: 8%;">Acão</th>
                            </tr>
                            </thead>
                        </table>
                        <!-- Fim Table de relacoes -->
                    </div>
                    <!-- Fim do Gerendiamento dos relacoes -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos relacoes-->
