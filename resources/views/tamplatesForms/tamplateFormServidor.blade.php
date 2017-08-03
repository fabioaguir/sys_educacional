<div class="block-header">
    <h2>Cadastro de Servidor</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <input type="hidden" id="idServidor" value="{{ isset($model->cgm->id) ? $model->cgm->id : null }}">

        <!-- Painel -->
        <div role="tabpanel">
            <!-- Guias -->
            <ul id="tabs" class="tab-nav" role="tablist" data-tab-color="cyan">
                <li class="active"><a href="#infoBasicas" aria-controls="infoBasicas" role="tab" data-toggle="tab">Informações Básicas</a>
                </li>
                <li><a href="#documentacao" aria-controls="documentacao" role="tab" data-toggle="tab">Documentação</a>
                </li>
                <li><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a>
                </li>
                <li><a href="#docProfiss" aria-controls="docProfiss" role="tab" data-toggle="tab">Doc. Profissionais</a>
                </li>
                <li><a href="#dadosProfiss" aria-controls="dadosProfiss" role="tab" data-toggle="tab">Dados Profissionais</a>
                </li>
                <li><a href="#situacao" aria-controls="situacao" role="tab" data-toggle="tab">Situação do Servidor</a>
                </li>
            </ul>
            <!-- Fim Guias -->

            <!-- Conteúdo -->
            <div class="tab-content">
                {{--#1--}}
                <div role="tabpanel" class="tab-pane active" id="infoBasicas">
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[nome]">Nome *</label>
                                    {!! Form::text('cgm[nome]', Session::getOldInput('cgm[nome]'), array('id' => 'nome', 'class' => 'form-control input-sm', 'placeholder' => 'Nome Completo')) !!}
                                    <input type="hidden" value="" name="cgm_id" id="cgm_id">
                                    <input type="hidden" value="" name="endereco_id" id="endereco_id">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label for="nome_id"></label>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm m-t-10"  {{--data-toggle="modal" data-target="#modal-pesquisar-pessoa"--}} id="nome-search" style="margin-left: -31px;" type="button">
                                    Pesquisar
                                </button>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <div class=" fg-line">
                                <label for="cgm[sexo_id]">Sexo *</label>
                                <div class="select">
                                    {!! Form::select('cgm[sexo_id]', (["" => "Selecione gênero"] + $loadFields['sexo']->toArray()), null, array('id' => 'sexo_id', 'class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_nascimento]">Data de Nascimento *</label>
                                    {!! Form::text('cgm[data_nascimento]', Session::getOldInput('cgm[data_nascimento]'), ['id' => 'data_nascimento', 'class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de Nascimento']) !!}
                                    {{--{!! Form::text('data_nascimento', Session::getOldInput('data_nascimento'), array('class' => 'form-control input-sm', 'placeholder' => 'Data de Nascimento')) !!}--}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_falecimento]">Data de Falecimento</label>
                                    {!! Form::text('cgm[data_falecimento]', Session::getOldInput('cgm[data_falecimento]'), array('id' => 'data_falecimento', 'class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de Falecimento')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[nacionalidade_id]">Nacionalidade *</label>
                                <div class="select">
                                    {!! Form::select('cgm[nacionalidade_id]', (["" => "Selecione local"] + $loadFields['nacionalidade']->toArray()), null, array('id' => 'nacionalidade_id', 'class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[naturalidade]">Naturalidade</label>
                                    {!! Form::text('cgm[naturalidade]', Session::getOldInput('cgm[naturalidade]'), array('id' => 'naturalidade',  'class' => 'form-control input-sm', 'placeholder' => 'Naturalidade')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[inscricao_estadual]">Inscrição Estadual</label>
                                    {!! Form::text('cgm[inscricao_estadual]', Session::getOldInput('cgm[inscricao_estadual]'), array('id' => 'inscricao_estadual', 'class' => 'form-control input-sm', 'placeholder' => 'Inscricao Estadual')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[cgm_municipio_id]">CGM do Município *</label>
                                <div class="select">
                                    {!! Form::select('cgm[cgm_municipio_id]', (["" => "Selecione"] + $loadFields['cgmmunicipio']->toArray()), null, array('id' => 'cgm_municipio_id', 'class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[email]">E-mail</label>
                                    {!! Form::text('cgm[email]', Session::getOldInput('cgm[email]'), array('id' => 'email', 'class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[telefones]">Telefones</label>
                                    {!! Form::text('cgm[telefones]', Session::getOldInput('cgm[telefones]'), array('class' => 'form-control input-sm')) !!}
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>

                {{--#2--}}
                <div role="tabpanel" class="tab-pane" id="documentacao">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[pai]">Nome Pai</label>
                                    {!! Form::text('cgm[pai]', Session::getOldInput('cgm[pai]'), array('id' => 'pai', 'class' => 'form-control input-sm', 'placeholder' => 'Nome do pai completo')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[mae]">Nome Mãe</label>
                                    {!! Form::text('cgm[mae]', Session::getOldInput('cgm[mae]'), array('id' => 'mae', 'class' => 'form-control input-sm', 'placeholder' => 'Nome da mãe completo')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[estado_civil_id]">Estado Civil *</label>
                                <div class="select">
                                    {!! Form::select('cgm[estado_civil_id]', (["" => "Selecione gênero"] + $loadFields['estadocivil']->toArray()), null, array('id' => 'estado_civil_id', 'class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[escolaridade_id]">Escolaridade *</label>
                                <div class="select">
                                    {!! Form::select('cgm[escolaridade_id]', (["" => "Selecione grau"] + $loadFields['escolaridade']->toArray()), null, array('id' => 'escolaridade_id', 'class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[cpf]">CPF *</label>
                                    {!! Form::text('cgm[cpf]', Session::getOldInput('cgm[cpf]'), array('id' => 'cpf', 'class' => 'form-control input-sm', 'placeholder' => 'CPF')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[rg]">RG *</label>
                                    {!! Form::text('cgm[rg]', Session::getOldInput('cgm[rg]'), array('id' => 'rg', 'class' => 'form-control input-sm', 'placeholder' => 'RG')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[orgao_emissor]">Orgão Emissor</label>
                                    {!! Form::text('cgm[orgao_emissor]', Session::getOldInput('cgm[orgao_emissor]'), array('id' => 'orgao_emissor',  'class' => 'form-control input-sm', 'placeholder' => 'Orgão Emissor')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_expedicao]">Data de expedição</label>
                                    {!! Form::text('cgm[data_expedicao]', Session::getOldInput('cgm[data_expedicao]'), array('id' => 'data_expedicao', 'class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de expedição')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[num_cnh]">Número da CNH</label>
                                    {!! Form::text('cgm[num_cnh]', Session::getOldInput('cgm[num_cnh]'), array('id' => 'num_cnh', 'class' => 'form-control input-sm', 'placeholder' => 'Número da CNH')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_vencimento_cnh]">Data Vencimento</label>
                                    {!! Form::text('cgm[data_vencimento_cnh]', Session::getOldInput('cgm[data_vencimento_cnh]'), array('id' => 'data_vencimento_cnh', 'class' => 'form-control input-sm date-picker', 'placeholder' => 'Data Vencimento')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[cnh_categoria_id]">Categoria CNH</label>
                                <div class="select">
                                    {!! Form::select('cgm[cnh_categoria_id]', ["" => "Selecione"], null, array('id' => 'cnh_categoria_id', 'class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--#3--}}
                <div role="tabpanel" class="tab-pane" id="endereco">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[logradouro]">Logradouro *</label>
                                    {!! Form::text("cgm[endereco][logradouro]", Session::getOldInput("cgm[endereco][logradouro]"), array('id' => 'logradouro', 'class' => 'form-control input-sm', 'placeholder' => 'Logradouro')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[endereco][numero]">Número *</label>
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
                                    {!! Form::text("cgm[endereco][complemento]", Session::getOldInput("cgm[endereco][complemento]"), array('id' => 'complemento', 'class' => 'form-control input-sm', 'placeholder' => 'Complemento')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
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
                                <label for="estado">Estado *</label>
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
                                <label for="cidade">Cidade *</label>
                                @if(isset($model->cgm->endereco->bairro->cidade->id))
                                    <div class="select">
                                        {!! Form::select("cidade", array($model->cgm->endereco->bairro->cidade->id => $model->cgm->endereco->bairro->cidade->nome), $model->cgm->endereco->bairro->cidade->id, array('class' => 'form-control', 'id' => 'cidade')) !!}
                                    </div>
                                @else
                                    <div class="select">
                                        {!! Form::select('cidade', array(), Session::getOldInput('cidade_id'), array('class' => 'form-control', 'id' => 'cidade')) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[endereco][bairro_id]">Bairro *</label>
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
                {{-- fim --}}


                {{--#4--}}
                <div role="tabpanel" class="tab-pane" id="docProfiss">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[carteira_prof]">Carteira Profissional</label>
                                    {!! Form::text("cgm[carteira_prof]", Session::getOldInput("cgm[carteira_prof]"), array('id' => 'carteira_prof', 'class' => 'form-control input-sm', 'placeholder' => 'Carteira Profissional')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[serie_carteira]">Série da carteira</label>
                                    {!! Form::text("cgm[serie_carteira]", Session::getOldInput("cgm[serie_carteira]"), array('id' => 'serie_carteira', 'class' => 'form-control input-sm', 'placeholder' => 'Série da carteira')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[numero_titulo]">Título de eleitor</label>
                                    {!! Form::text("cgm[numero_titulo]", Session::getOldInput("cgm[numero_titulo]"), array('id' => 'numero_titulo', 'class' => 'form-control input-sm', 'placeholder' => 'Título de eleitor')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[numero_sessao]">Sessão do título</label>
                                    {!! Form::text("cgm[numero_sessao]", Session::getOldInput("cgm[numero_sessao]"), array('id' => 'numero_sessao', 'class' => 'form-control input-sm', 'placeholder' => 'Sessão do título')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[numero_zona]">Zona do título</label>
                                    {!! Form::text("cgm[numero_zona]", Session::getOldInput("cgm[numero_zona]"), array('id' => 'numero_zona', 'class' => 'form-control input-sm', 'placeholder' => 'Zona do título')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[pis_pasep]">PIS/PASEP</label>
                                    {!! Form::text("pis_pasep", Session::getOldInput("pis_pasep"), array('class' => 'form-control input-sm', 'placeholder' => 'PIS/PASEP')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim --}}


                {{--#5--}}
                <div role="tabpanel" class="tab-pane" id="dadosProfiss">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="matricula">Matrícula</label>
                                    {!! Form::text("matricular", Session::getOldInput("matricular"), array('class' => 'form-control input-sm', 'placeholder' => 'Matrícula')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[data_admicao]">Data de admissão *</label>
                                    {!! Form::text("data_admicao", Session::getOldInput("data_admicao"), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de admissão')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[carga_horaria]">Carga horária *</label>
                                    {!! Form::text("carga_horaria", Session::getOldInput("carga_horaria"), array('class' => 'form-control input-sm', 'placeholder' => 'Carga horária')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[tipo_vinculo_servidor_id]">Tipo de vínculo *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("tipo_vinculo_servidor_id", (["" => "Selecione o tipo"] + $loadFields['tipovinculo']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[habilitacao_escolaridade_id]">Habilitação\Escolaridade</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("habilitacao_escolaridade_id", (["" => "Selecione"] + $loadFields['habilitacaoescolaridade']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[cargos_id]">Cargo *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("cargos_id", (["" => "Selecione"] + $loadFields['cargo']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[funcoes_id]">Função *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("funcoes_id", (["" => "Selecione"] + $loadFields['funcao']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim --}}

                {{--#6--}}
                <div role="tabpanel" class="tab-pane" id="situacao">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[situacao_servidores_id]">Situação</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("situacao_servidores_id", (["" => "Selecione"] + $loadFields['situacao']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim --}}

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('servidor.index') }}">Voltar</a>
            </div>
            <!-- Fim Conteúdo -->
        </div>
        <!-- Fim Painel -->
    </div>
</div>

@include('modal.modal_pesquisar_pessoa')

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/unique.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/dateBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/cpfBR.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/servidor.js')  }}"></script>

    <script type="text/javascript" src="{{ asset('/dist/servidor/modal_pesquisar_pessoa.js')  }}"></script>
    <script type="text/javascript">

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
                    url: '{{ route('pessoaFisica.findCidade')  }}',
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
                    url: '{{ route('pessoaFisica.findBairro')  }}',
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
    </script>
@endsection