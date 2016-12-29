<!-- Modal de cadastro das atividades-->
<div id="modal-adicionar-atividades" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Atividades</h4>
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

                    <!-- Gerendiamento dos atividades -->
                    <div class="col-md-12">
                        <!-- Adicionar atividades -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="funcao">Atividade *</label>
                                    <div class="select">
                                        {!! Form::select("funcao", array(), null, array('class'=> 'form-control', 'id' => 'funcao')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="horaManha">Horas Manhã *</label>
                                        {!! Form::text('horaManha', null, array('class' => 'form-control input-sm', 'id' => 'horaManha', 'placeholder' => 'Horas Manhã')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="horaTarde">Horas Tarde</label>
                                        {!! Form::text('horaTarde', null, array('class' => 'form-control input-sm', 'id' => 'horaTarde', 'placeholder' => 'Horas Tarde')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="horaNoite">Horas Noite</label>
                                        {!! Form::text('horaNoite', null, array('class' => 'form-control input-sm', 'id' => 'horaNoite', 'placeholder' => 'Horas Noite')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line" style="margin-top: 20px">
                                    <div class="fg-line">
                                        <button type="button" id="addAtividade" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        <button style="margin-left: 5px" type="button" id="edtAtividade" class="btn btn-success btn-sm m-t-10">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar atividades -->

                        <!-- Table de atividades -->
                        <table id="atividades-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Atividade</th>
                                <th>Hora Manhã</th>
                                <th>Hora Tarde</th>
                                <th>Hora Noite</th>
                                <th style="width: 8%;">Acão</th>
                            </tr>
                            </thead>
                        </table>
                        <!-- Fim Table de atividades -->
                    </div>
                    <!-- Fim do Gerendiamento dos atividades -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos atividades-->
