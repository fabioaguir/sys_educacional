<!-- Modal de cadastro dos horários -->
<div id="modal-horarios" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Horários</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="hoCodigo"></p></span>
                                </div>

                                <div class="col-md-6">
                                    <span><strong>Nome: </strong><p id="hoNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group col-md-3">
                            <div class=" fg-line">
                                <label for="tipo-turma">Turma do 6º ao 9º ano? *</label>
                                <select class="form-control" id="tipo-turma">
                                    <option value="">Selecione a opção</option>
                                    <option value="1">Sim</option>
                                    <option value="2">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class=" fg-line">
                                <label for="dia">Dia *</label>
                                {!! Form::select("dia", array(), null, array('class'=> 'form-control', 'id' => 'dia')) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class=" fg-line">
                                <label for="hora">Hora *</label>
                                <div class="select">
                                    {!! Form::select("hora", array(), null, array('class'=> 'form-control', 'id' => 'hora')) !!}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group col-md-5">
                            <div class=" fg-line">
                                <label for="professor">Professore *</label>
                                <div class="select">
                                    {!! Form::select("professor", array(), null, array('class'=> 'form-control', 'id' => 'professor')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" id="div-disciplina">
                            <div class=" fg-line">
                                <label for="disciplina">Disciplina *</label>
                                <div class="select">
                                    {!! Form::select("disciplina", array(), null, array('class'=> 'form-control', 'id' => 'disciplina')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div class="fg-line" style="margin-top: 20px">
                                <div class="fg-line">
                                    <button type="button" id="addHorario" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                    {{--<button style="margin-left: 5px" type="button" id="edtTelefone" class="btn btn-success btn-sm m-t-10">Editar</button>--}}
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Gerendiamento dos horários -->
                    <div class="col-md-12">
                        <!-- Table de horários -->
                        <div class="table-responsive">
                            <table id="horarios-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Dia</th>
                                    <th>Turno</th>
                                    <th>Hora</th>
                                    <th>Disciplina</th>
                                    <th>Professor</th>
                                    <th style="width: 10%">Ação</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de horários -->
                    </div>
                    <!-- Fim do Gerendiamento dos horários -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro de horários-->
