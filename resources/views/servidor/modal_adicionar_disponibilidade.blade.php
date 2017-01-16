<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-disponibilidades" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Disponibilidade</h4>
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

                    <!-- Gerendiamento das Disponibilidades -->
                    <div class="col-md-12">
                        <!-- Adicionar Disponibilidade -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="form-group col-md-4">
                                <div class=" fg-line">
                                    <label for="regime">Escola *</label>
                                    <div class="select">
                                        {!! Form::select("escolaDisp", array(), null, array('class'=> 'form-control', 'id' => 'escolaDisp')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="ensino">Turno *</label>
                                    <div class="select">
                                        {!! Form::select("turno", array(), null, array('class'=> 'form-control', 'id' => 'turno')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="ensino">Horário *</label>
                                    <div class="select">
                                        {!! Form::select("hora", array(), null, array('class'=> 'form-control', 'id' => 'hora')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="area">Dia *</label>
                                    <div class="select">
                                        {!! Form::select("dia", array(), null, array('class'=> 'form-control', 'id' => 'dia')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="fg-line" style="margin-top: 20px">
                                    <div class="fg-line">
                                        <button type="button" id="addDisponibilidade" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        <button style="margin-left: 5px" type="button" id="edtDisponibilidade" class="btn btn-success btn-sm m-t-10">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Disponibilidades -->

                        <!-- Table de Disponibilidades -->
                        <div class="table-responsive">
                            <table id="disponibilidades-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Turno</th>
                                    <th>Dia</th>
                                    <th>Horário</th>
                                    <th>Escola</th>
                                    <th style="width: 8%;">Acão</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de Disponibilidades -->
                    </div>
                    <!-- Fim do Gerendiamento das Disponibilidades -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dss Disponibilidades-->
