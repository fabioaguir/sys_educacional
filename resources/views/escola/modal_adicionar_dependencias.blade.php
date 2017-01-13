<!-- Modal de cadastro das Dependencia-->
<div id="modal-adicionar-dependencias" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Adicionar Dependências</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" style="background-color: #e6e9dc">
                                <div class="col-md-4" style="margin-top: 17px">
                                    <span><strong>Nome: </strong><p class="eNome"></p></span>
                                </div>

                                <div class="col-md-2" style="margin-top: 17px">
                                    <span><strong>Código: </strong><p class="eCodigo"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 2%;">

                    <!-- Gerendiamento dos Dependencia -->
                    <div class="col-md-12">
                        <!-- Adicionar Telefones -->
                        <div class="row" style="margin-top: -2%; margin-bottom: 3%;">
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="nome">Nome *</label>
                                        {!! Form::text('nome', null, array('class' => 'form-control input-sm', 'id' => 'nome', 'placeholder' => 'Nome')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line">
                                    <div class="fg-line">
                                        <label for="capacidade">Capacidade *</label>
                                        {!! Form::text('capacidade', null, array('class' => 'form-control input-sm', 'id' => 'capacidade', 'placeholder' => 'Capacidade')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="fg-line" style="margin-top: 20px">
                                    <div class="fg-line">
                                        <button type="button" id="addDependencia" class="btn btn-primary btn-sm m-t-10">Adicionar</button>
                                        <button style="margin-left: 5px" type="button" id="edtDependencia" class="btn btn-success btn-sm m-t-10">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Adicionar Dependencia -->

                        <!-- Table de telefones -->
                        <div class="table-responsive">
                            <table id="dependencias-grid" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Capacidade</th>
                                    <th style="width: 8%;">Acão</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- Fim Table de Dependencia -->
                    </div>
                    <!-- Fim do Gerendiamento dos Dependencia -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro dos Dependencia-->
