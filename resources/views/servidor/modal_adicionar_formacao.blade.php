<!-- Modal de cadastro das Disciplinas-->
<div id="modal-adicionar-formacoes" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Formações</h4>
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
                    <!-- Gerendiamento das formações -->
                    <div class="col-md-12">
                        <!-- Adicionar formações -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 1%;">
                            <div class="col-md-8">
                                <fieldset>
                                    <legend>Cusrso superior</legend>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class=" fg-line">
                                            <label for="curso">Curso *</label>
                                            <div class="select">
                                                {!! Form::select("curso", array(), null, array('class'=> 'form-control', 'id' => 'curso')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class=" fg-line">
                                            <label for="instituicao">Instiruição *</label>
                                            <div class="select">
                                                {!! Form::select("instituicao", array(), null, array('class'=> 'form-control', 'id' => 'instituicao')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="fg-line">
                                            <label for="situacao">Situação *</label>
                                            <div class="select">
                                                {!! Form::select("situacao", array(), null, array('class'=> 'form-control', 'id' => 'situacao')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="fg-line">
                                            <label for="licenciatura">Licenciatura *</label>
                                            <div class="select">
                                                {!! Form::select("licenciatura", array(), null, array('class'=> 'form-control', 'id' => 'licenciatura')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="fg-line">
                                            <div class="fg-line">
                                                <label for="ano">Ano Conclusão *</label>
                                                {!! Form::text('ano', null, array('class' => 'form-control input-sm', 'id' => 'ano', 'placeholder' => 'Ano de conclusão')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </fieldset>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="fg-line">
                                            <div class="fg-line">
                                                <button type="button" id="addFormacao" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                                <button style="margin-left: 5px" type="button" id="edtFormacao" class="btn btn-success btn-sm m-t-10">Editar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <fieldset>
                                    <legend> Pós-graduação</legend>
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <label for="select-posgraduacao">
                                                Pós - Graduação
                                                <select class="js-example-basic-single js-states form-control" multiple id="select-posgraduacao">
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <label for="select-outroscursos">
                                                Outros Cursos
                                                <select class="js-example-basic-single js-states form-control" multiple id="select-outroscursos">
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="fg-line">
                                                <div class="fg-line">
                                                    <button type="button" id="addPos" class="btn btn-primary btn-sm m-t-10">Alterar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!-- Fim Adicionar relacoes -->

                        <!-- Table de relacoes -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="formacoes-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Curso</th>
                                            <th>Instituição</th>
                                            <th>Licenciatura</th>
                                            <th>Situação</th>
                                            <th>Ano de conclusão</th>
                                            <th style="width: 8%;">Acão</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Table de formações -->
                    </div>
                    <!-- Fim do Gerendiamento dos formações -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos formações-->
