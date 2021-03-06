<div class="block-header">
    <h2>Cadastro de Alunos</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <input type="hidden" id="idAluno" value="{{ isset($model->cgm->id) ? $model->cgm->id : null }}">

        <div class="row">
            <div class="col-md-12">

                <!-- Painel -->
                <div role="tabpanel">
                    <!-- Guias -->
                    <ul id="tabs" class="tab-nav" role="tablist" data-tab-color="cyan">
                        <li class="active"><a href="#dadosPessoais" aria-controls="dadosPessoais" role="tab" data-toggle="tab">Dados Pessoais</a>
                        </li>
                        <li><a href="#documento" aria-controls="documento" role="tab" data-toggle="tab">Documentos</a>
                        </li>
                        <li><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a>
                        </li>
                    </ul>
                    <!-- Fim Guias -->

                    <!-- Conteúdo -->
                    <div class="tab-content">
                        {{--#1--}}
                        <div role="tabpanel" class="tab-pane active" id="dadosPessoais">

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" id="captura" data-trigger="fileinput"
                                             style="width: 135px; height: 115px;">
                                            @if(isset($model) && $model->cgm->path_image != null)
                                                <div id="midias">
                                                    <img id="logo"
                                                         src="{{route('aluno.getImgAluno', ['id' => $model->cgm->id])}}"
                                                         alt="Foto" height="120" width="100"/><br/>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                           <span class="btn btn-primary btn-xs btn-block btn-file">
                                               <span class="fileinput-new">Selecionar</span>
                                               <input type="file" id="img" name="img">
                                               <input type="hidden" id="cod_img" name="cod_img">
                                           </span>
                                            <input type=button id="foto" value="Webcam"
                                                   class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                                   data-target="#myModal">
                                            <!--<a href="#" class="btn btn-warning btn-xs fileinput-exists col-md-6" data-dismiss="fileinput">Remover</a>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[nome]">Nome *</label>
                                            {!! Form::text('cgm[nome]', Session::getOldInput('cgm[nome]'), array('class' => 'form-control input-sm upercase', 'id' => 'nome', 'placeholder' => 'Nome completo')) !!}
                                            <input type="hidden" value="@if(isset($model)) {{ $model->cgm->id }} @endif" name="cgm_id" id="cgm_id">
                                            <input type="hidden" value="" name="endereco_id" id="endereco_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label for="nome_id"></label>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm m-t-10"   id="nome-search" style="margin-left: -31px;" type="button">
                                            Pesquisar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="num_inep">INEP</label>
                                            {!! Form::text('num_inep', Session::getOldInput('num_inep'), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="num_nis">NIS</label>
                                            {!! Form::text('cgm[numero_nis]', Session::getOldInput('num_nis'), array('class' => 'form-control input-sm', 'id' => 'numero_nis', 'placeholder' => 'Número')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <label for="codigo">Código</label>
                                        {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do aluno')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[data_nascimento]">Data de Nascimento</label>
                                            {!! Form::text('cgm[data_nascimento]', Session::getOldInput('cgm[data_nascimento]'), array('class' => 'form-control input-sm date-picker', 'id' => 'data_nascimento', 'placeholder' => 'Data de Nascimento')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class=" fg-line">
                                        <label for="cgm[sexo_id]">Gênero</label>
                                        <div class="select">
                                            {!! Form::select('cgm[sexo_id]', (["" => "Selecione Gênero"] + $loadFields['sexo']->toArray()), null, array('id' => 'sexo_id', 'class'=> 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[pai]">Nome Pai</label>
                                            {!! Form::text('cgm[pai]', Session::getOldInput('cgm[pai]'), array('id' => 'pai', 'class' => 'form-control input-sm', 'placeholder' => 'Nome completo do pai')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[mae]">Nome Mãe *</label>
                                            {!! Form::text('cgm[mae]', Session::getOldInput('cgm[mae]'), array('id' => 'mae', 'class' => 'form-control input-sm', 'placeholder' => 'Nome completo da mãe')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <label for="profissao_pai">Profissão Pai *</label>
                                        {!! Form::text('profissao_pai', Session::getOldInput('profissao_pai'), array('class' => 'form-control input-sm', 'placeholder' => 'Profissão do Pai')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <label for="profissao_mae">Profissão Mãe *</label>
                                        {!! Form::text('profissao_mae', Session::getOldInput('profissao_mae'), array('class' => 'form-control input-sm', 'placeholder' => 'Profissão Mãe')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="telefone[nome]">Telefone *</label>
                                            @if (isset($model->cgm))
                                                {!! Form::text('telefone[nome]', $model->cgm->telefone->first()->nome ?? '', array('id' => 'telefone', 'class' => 'form-control input-sm', 'placeholder' => 'Telefone do responsável')) !!}
                                            @else
                                                {!! Form::text('telefone[nome]', Session::getOldInput('telefone[nome]'), array('id' => 'telefone', 'class' => 'form-control input-sm', 'placeholder' => 'Telefone do responsável')) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[email]">E-mail</label>
                                            {!! Form::text('cgm[email]', Session::getOldInput('cgm[email]'), array('id' => 'email', 'class' => 'form-control input-sm', 'placeholder' => 'Endereço eletrônico')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class=" fg-line">
                                        <label for="cgm[nacionalidade_id]">Nacionalidade</label>
                                        {!! Form::select('cgm[nacionalidade_id]', (["" => "Selecione nacionalidade"] + $loadFields['nacionalidade']->toArray()), null, array('id' => 'nacionalidade_id', 'class'=> 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <label for="cgm[naturalidade]">Naturalidade</label>
                                        {!! Form::text('cgm[naturalidade]', Session::getOldInput('cgm[naturalidade]'), array('id' => 'naturalidade', 'class' => 'form-control input-sm', 'placeholder' => 'Cidade natal')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class=" fg-line">
                                        <label for="necessidade_especial_id">Necessidade especial *</label>
                                        {!! Form::select('necessidade_especial_id', (["" => "Selecione"] + $loadFields['necessidadeespecial']->toArray()), null, array('class'=> 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="cid_patologia">Cid Patologia</label>
                                        {!! Form::text('cid_patologia', Session::getOldInput('cid_patologia'), array('class' => 'form-control input-sm', 'placeholder' => 'Cid Patologia')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class=" fg-line">
                                        <label for="transporte_escolar_id">Transporte Escolar *</label>
                                        {!! Form::select('transporte_escolar_id', (["" => "Selecione"] + $loadFields['transporteescolar']->toArray()), null, array('class'=> 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--#1--}}

                        {{--#2--}}
                        <div role="tabpanel" class="tab-pane" id="documento">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="cgm[cpf]">CPF</label>
                                        {!! Form::text('cgm[cpf]', Session::getOldInput('cgm[cpf]'), array('id' => 'cpf', 'class' => 'form-control input-sm', 'placeholder' => 'CPF')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="cgm[rg]">RG</label>
                                        {!! Form::text('cgm[rg]', Session::getOldInput('cgm[rg]'), array( 'id' => 'rg',  'class' => 'form-control input-sm', 'placeholder' => 'RG')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <label for="nome_cartorio_rg_civil">Nome do cartório de registro Civil *</label>
                                        {!! Form::text('nome_cartorio_rg_civil', Session::getOldInput('nome_cartorio_rg_civil'), array( 'class' => 'form-control input-sm', 'placeholder' => 'Nome do cartório de registro Civil')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <label for="num_registro_nascimento">Número registro de nascimento *</label>
                                        {!! Form::text('num_registro_nascimento', Session::getOldInput('num_registro_nascimento'), array( 'class' => 'form-control input-sm', 'placeholder' => 'Número registro de nascimento')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="livro">Livro *</label>
                                        {!! Form::text('livro', Session::getOldInput('livro'), array( 'class' => 'form-control input-sm', 'placeholder' => 'Livro')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="folha">Folha *</label>
                                        {!! Form::text('folha', Session::getOldInput('folha'), array( 'class' => 'form-control input-sm', 'placeholder' => 'Folha')) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="fg-line">
                                        <label for="data_emissao">Data de emissão *</label>
                                        {!! Form::text('data_emissao', Session::getOldInput('data_emissao'), array( 'class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de emissão')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="estado_certidao">Estado certidão *</label>
                                        @if(isset($model->cidade->estado->id))
                                            <div class="select">
                                                {!! Form::select("estado_certidao", (["" => "Selecione"] + $loadFields['estado']->toArray()), $model->cidade->estado->id, array('class' => 'form-control', 'id' => 'estado_certidao')) !!}
                                            </div>
                                        @else
                                            <div class="select">
                                                {!! Form::select("estado_certidao", (["" => "Selecione"] + $loadFields['estado']->toArray()), null,array('class' => 'form-control', 'id' => 'estado_certidao')) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cidade_certidao">Cidade certidão *</label>
                                        @if(isset($model->cidade->id))
                                            <div class="select">
                                                {!! Form::select("cidade_certidao", array($model->cidade->id => $model->cidade->nome), $model->cidade->id, array('class' => 'form-control', 'id' => 'cidade_certidao')) !!}
                                            </div>
                                        @else
                                            <div class="select">
                                                {!! Form::select("cidade_certidao", array(), Session::getOldInput('cidade_certidao'), array('class' => 'form-control', 'id' => 'cidade_certidao')) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--#3--}}
                        <div role="tabpanel" class="tab-pane" id="endereco">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][logradouro]">Logradouro</label>
                                            {!! Form::text("cgm[endereco][logradouro]", Session::getOldInput("cgm[endereco][logradouro]"), array('id' => 'logradouro', 'class' => 'form-control input-sm', 'placeholder' => 'Logradouro')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][numero]">Número</label>
                                            {!! Form::text("cgm[endereco][numero]", Session::getOldInput("cgm[endereco][numero]"), array('id' => 'numero', 'class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][complemento]">Complemento</label>
                                            {!! Form::text("cgm[endereco][complemento]", Session::getOldInput("cgm[endereco][complemento]"), array('id' => 'complemento', 'class' => 'form-control input-sm', 'placeholder' => 'Ponto de referência')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][cep]">CEP</label>
                                            {!! Form::text("cgm[endereco][cep]", Session::getOldInput("cgm[endereco][cep]"), array('id' => 'cep', 'class' => 'form-control input-sm', 'placeholder' => 'CEP')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cgm[endereco][zona_id]">Zona</label>
                                        <div class="select">
                                            {!! Form::select("cgm[endereco][zona_id]", (["" => "Selecione zona"] + $loadFields['zona']->toArray()), null, array('id' => 'zona_id', 'class' => 'form-control Form::select')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="estado">Estado</label>
                                        @if(isset($model->cgm->endereco->bairro->cidade->estado->id))
                                            <div class="select">
                                                {!! Form::select("estado", (["" => "Selecione"] + $loadFields['estado']->toArray()), $model->cgm->endereco->bairro->cidade->estado->id, array('class' => 'form-control', 'id' => 'estado')) !!}
                                            </div>
                                        @else
                                            <div class="select">
                                                {!! Form::select("estado", (["" => "Selecione"] + $loadFields['estado']->toArray()), null,array('class' => 'form-control', 'id' => 'estado')) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cidade">Cidade</label>
                                        @if(isset($model->cgm->endereco->bairro->cidade->id))
                                            <div class="select">
                                                {!! Form::select("cidade", array($model->cgm->endereco->bairro->cidade->id => $model->cgm->endereco->bairro->cidade->nome), $model->cgm->endereco->bairro->cidade->id, array('class' => 'form-control', 'id' => 'cidade')) !!}
                                            </div>
                                        @else
                                            <div class="select">
                                                {!! Form::select("cidade", array(), Session::getOldInput('cidade'), array('class' => 'form-control', 'id' => 'cidade')) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cgm[endereco][bairro_id]">Bairro</label>
                                        @if(isset($model->cgm->endereco->bairro->id))
                                            <div class="select">
                                                {!! Form::select("cgm[endereco][bairro_id]", array($model->cgm->endereco->bairro->id => $model->cgm->endereco->bairro->nome), $model->cgm->endereco->bairro->id, array('class' => 'form-control', 'id' => 'bairro')) !!}
                                            </div>
                                        @else
                                            <div class="select">
                                                {!! Form::select("cgm[endereco][bairro_id]", array(), Session::getOldInput('bairro'),array('class' => 'form-control', 'id' => 'bairro')) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--#2--}}
                    </div>
                    <!-- Conteúdo -->
                </div>
                <!-- Painel -->
                <button class="btn btn-primary btn-sm m-t-10 submit">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('aluno.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade my-profile" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Foto</h4>
            </div>
            <div class="modal-body">
                <div style="margin-left: -11px;" id="my_camera"></div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button type="button" onClick="take_snapshot()" class="btn btn-primary">Tirar foto</button>
            </div>
        </div>
    </div>
</div>
{{--</div>--}}


@include('modal.modal_pesquisar_pessoa')

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/cpfBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/dateBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/aluno.js')  }}"></script>


    <script type="text/javascript" src="{{ asset('/dist/aluno/modal_pesquisar_pessoa.js')  }}"></script>

    <script type="text/javascript">

        Webcam.set({
            width: 260,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        $(document).on('click', '#foto', function(){
            Webcam.attach( '#my_camera' );
        });

        function take_snapshot() {

            // take snapshot and get image data
            Webcam.snap( function(data_uri) {

                // display results in page
                document.getElementById('captura').innerHTML = '<img src="'+data_uri+'"/>';
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                document.getElementById('cod_img').value = raw_image_data;

                $(".my-profile").modal('hide');
                Webcam.reset();
                // $(".modal-dialog").modal('toggle');

            } );
        }

        {{-- MASCARAS --}}
        $(document).ready(function() {
            //$('#cpf').mask('000.000.000-00', {reverse: true});
            $('#telefone').mask('(00) 00000-0000');
            $('#cep').mask('00.000-000');
        });

        $( "#formAluno" ).submit(function() {
            //$('#cpf').unmask();
            $('#telefone').unmask();
            $('#cep').unmask();
        });
        {{-- MASCARAS --}}

        //Incio - Retorno de cidades associadas aos estados
        $(document).on('change', "#estado", function () {

            //Removendo as cidades
            $('#cidade option').remove();

            //Recuperando o estado
            var estado = $(this).val();

            if (estado !== "") {
                var dados = {
                    'id' : estado
                };

                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('aluno.findCidade')  }}',
                    data: dados,
                    datatype: 'json',
                    headers: {
                        'X-CSRF-TOKEN' : '{{  csrf_token() }}'
                    },
                }).done(function (json) {
                    var option = "";

                    option += '<option value="">Selecione um municipio</option>';
                    for (var i = 0; i < json.length; i++) {
                        option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                    }

                    $('#cidade option').remove();
                    $('#cidade').append(option);
                });
            }
        });
        //Fim - Retorno de cidades associadas ao estados

        //Incio - Retorno de cidades associadas aos estados
        $(document).on('change', "#cidade", function () {

            //Removendo as cidades
            $('#bairro option').remove();

            //Recuperando o estado
            var estado = $(this).val();

            if (estado !== "") {
                var dados = {
                    'id' : estado
                };

                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('aluno.findBairro')  }}',
                    data: dados,
                    datatype: 'json',
                    headers: {
                        'X-CSRF-TOKEN' : '{{  csrf_token() }}'
                    },
                }).done(function (json) {
                    var option = "";

                    option += '<option value="">Selecione um municipio</option>';
                    for (var i = 0; i < json.length; i++) {
                        option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                    }

                    $('#bairro option').remove();
                    $('#bairro').append(option);
                });
            }
        });
        //Fim - Retorno de cidades associadas ao estados

        //Incio - Retorno de cidades associadas aos estados certidão
        $(document).on('change', "#estado_certidao", function () {

            //Removendo as cidades
            $('#cidade_certidao option').remove();

            //Recuperando o estado
            var estado = $(this).val();

            if (estado !== "") {
                var dados = {
                    'id' : estado
                };

                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('aluno.findCidade')  }}',
                    data: dados,
                    datatype: 'json',
                }).done(function (json) {
                    var option = "";

                    option += '<option value="">Selecione um municipio</option>';
                    for (var i = 0; i < json.length; i++) {
                        option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                    }

                    $('#cidade_certidao option').remove();
                    $('#cidade_certidao').append(option);
                });
            }
        });
    </script>
@endsection
