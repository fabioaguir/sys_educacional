<!-- Modal de cadastro das Disciplinas-->
<div id="modal-disciplinas" class="modal fade modal-profile" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Disciplinas</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row" style="margin-bottom: 5%; background-color: #D3D3D3; border-bottom: #696969 solid;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <span><strong>Código: </strong><p id="dCodigo"></p></span>
                                </div>

                                <div class="col-md-2">
                                    <span><strong>Nome: </strong><p id="dNome"></p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Gerendiamento das Disciplinas da Séries -->
                    <div class="col-md-12">
                        <!-- Adicionar Disciplina -->
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<select id="select-disciplinas" class="form-control"></select>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-2">--}}
                                        {{--<input type="text" id="periodo" class="form-control" placeholder="Períodos">--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-2">--}}
                                        {{--<select id="obrigatorio" class="form-control">--}}
                                            {{--<option value="0">É obrigatória ? </option>--}}
                                            {{--<option value="1">Sim</option>--}}
                                            {{--<option value="0">Não</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-2">--}}
                                        {{--<button class="btn btn-primary" id="addDisciplina" type="button">Adicionar</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <!-- Fim Adicionar Disciplina -->

                        <!-- Table de disciplinas -->
                        <table id="disciplina-grid" class="display table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="width: 10%;">Código</th>
                                <th>Nome</th>
                                <th style="width: 10%;">Período</th>
                                <th style="width: 10%;">Obrigatório</th>
                            </tr>
                            </thead>
                        </table>
                        <!-- Fim Table de disciplinas -->
                    </div>
                    <!-- Fim do Gerendiamento das Disciplinas da Séries -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro das Disciplinas-->
