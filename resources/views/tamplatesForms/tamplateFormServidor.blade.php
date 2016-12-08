{{--{{ dd($loadFields) }}--}}
<div class="block-header">
    <h2>Cadastro de Servidor</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <!-- Painel -->
        <div role="tabpanel">
            <!-- Guias -->
            <ul class="tab-nav" role="tablist">
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
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[nome]">Nome *</label>
                                    {!! Form::text('cgm[nome]', Session::getOldInput('cgm[nome]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome Completo')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[sexo_id]">Sexo *</label>
                                <div class="select">
                                    {!! Form::select('cgm[sexo_id]', (["" => "Selecione gênero"] + $loadFields['sexo']->toArray()), null, array('class'=> 'chosen')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_nascimento]">Data de Nascimento *</label>
                                    {!! Form::date('cgm[data_nascimento]', Session::getOldInput('cgm[data_nascimento]'), ['class' => 'form-control input-sm', 'placeholder' => 'Data de Nascimento']) !!}
                                    {{--{!! Form::text('data_nascimento', Session::getOldInput('data_nascimento'), array('class' => 'form-control input-sm', 'placeholder' => 'Data de Nascimento')) !!}--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_falecimento]">Data de Falecimento *</label>
                                    {!! Form::text('cgm[data_falecimento]', Session::getOldInput('cgm[data_falecimento]'), array('class' => 'form-control input-sm', 'placeholder' => 'Data de Falecimento')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[nacionalidade_id]">Nacionalidade *</label>
                                <div class="select">
                                    {!! Form::select('cgm[nacionalidade_id]', (["" => "Selecione local"] + $loadFields['nacionalidade']->toArray()), null, array('class'=> 'chosen')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[naturalidade]">Naturalidade</label>
                                    {!! Form::text('cgm[naturalidade]', Session::getOldInput('cgm[naturalidade]'), array('class' => 'form-control input-sm', 'placeholder' => 'Naturalidade')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[inscricao_estadual]">Inscrição Estadual</label>
                                    {!! Form::text('cgm[inscricao_estadual]', Session::getOldInput('cgm[inscricao_estadual]'), array('class' => 'form-control input-sm', 'placeholder' => 'Inscricao Estadual')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[cgm_municipio_id]">CGM do Município *</label>
                                <div class="select">
                                    {!! Form::select('cgm[cgm_municipio_id]', (["" => "Selecione"] + $loadFields['cgmmunicipio']->toArray()), null, array('class'=> 'chosen')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[telefones]">Telefones</label>
                                    {!! Form::text('cgm[telefones]', Session::getOldInput('cgm[telefones]'), array('class' => 'form-control input-sm')) !!}
                                </div>
                            </div>
                        </div>
                        {{--<button class="btn btn-primary btn-sm m-t-10">Adicionar</button>--}}
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[email]">E-mail</label>
                                    {!! Form::text('cgm[email]', Session::getOldInput('cgm[email]'), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--#2--}}
                <div role="tabpanel" class="tab-pane" id="documentacao">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[pai]">Nome Pai *</label>
                                    {!! Form::text('cgm[pai]', Session::getOldInput('cgm[pai]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do pai completo')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[mae]">Nome Mãe *</label>
                                    {!! Form::text('cgm[mae]', Session::getOldInput('cgm[mae]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da mãe completo')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[estado_civil_id]">Estado Civil *</label>
                                <div class="select">
                                    {!! Form::select('cgm[estado_civil_id]', (["" => "Selecione gênero"] + $loadFields['estadocivil']->toArray()), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[escolaridade_id]">Escolaridade *</label>
                                <div class="select">
                                    {!! Form::select('cgm[escolaridade_id]', (["" => "Selecione grau"] + $loadFields['escolaridade']->toArray()), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[cpf]">CPF *</label>
                                    {!! Form::text('cgm[cpf]', Session::getOldInput('cgm[cpf]'), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[rg]">RG *</label>
                                    {!! Form::text('cgm[rg]', Session::getOldInput('cgm[rg]'), array('class' => 'form-control input-sm', 'placeholder' => 'REgistro geral')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[orgao_emissor]">Orgão Emissor *</label>
                                    {!! Form::text('cgm[orgao_emissor]', Session::getOldInput('cgm[orgao_emissor]'), array('class' => 'form-control input-sm', 'placeholder' => 'REgistro geral')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_expedicao]">Data de expedição *</label>
                                    {!! Form::text('cgm[data_expedicao]', Session::getOldInput('cgm[data_expedicao]'), array('class' => 'form-control input-sm', 'placeholder' => 'REgistro geral')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[num_cnh]">Número da CNH</label>
                                    {!! Form::text('cgm[num_cnh]', Session::getOldInput('cgm[num_cnh]'), array('class' => 'form-control input-sm', 'placeholder' => 'REgistro geral')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[data_vencimento_cnh]">Data Vencimento</label>
                                    {!! Form::text('cgm[data_vencimento_cnh]', Session::getOldInput('cgm[data_vencimento_cnh]'), array('class' => 'form-control input-sm', 'placeholder' => 'Registro geral')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[cnh_categoria_id]">Categoria CNH</label>
                                <div class="select">
                                    {!! Form::select('cgm[cnh_categoria_id]', ["" => "Selecione"], null, array()) !!}
                                </div>
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
                                    <label for="endereco[logradouro]">Logradouro *</label>
                                    {!! Form::text("cgm[endereco][logradouro]", Session::getOldInput("cgm[endereco][logradouro]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[endereco][numero]">Número *</label>
                                    {!! Form::text("cgm[endereco][numero]", Session::getOldInput("cgm[endereco][numero]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[endereco][comp]">Complemento</label>
                                    {!! Form::text("cgm[endereco][comp]", Session::getOldInput("cgm[endereco][comp]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cgm[endereco][cep]">CEP</label>
                                    {!! Form::text("cgm[endereco][cep]", Session::getOldInput("cgm[endereco][cep]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="estado">Estado *</label>
                                <div class="select">
                                    {!! Form::select("estado", (["" => "Selecione"] + $loadFields['estado']->toArray()), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cidade">Cidade *</label>
                                <div class="select">
                                    {!! Form::select("cidade", array(), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cgm[endereco][bairro_id]">Bairro *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("cgm[endereco][bairro_id]", array(), null, array()) !!}
                                </div>
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
                                    <label for="servidor[carteira_prof]">Carteira Profissional</label>
                                    {!! Form::text("carteira_prof", Session::getOldInput("carteira_prof"), array('class' => 'form-control input-sm', 'placeholder' => 'Carteira Profissional')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[serie_carteira]">Série da carteira</label>
                                    {!! Form::text("serie_carteira", Session::getOldInput("serie_carteira"), array('class' => 'form-control input-sm', 'placeholder' => 'Série da carteira')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[titulo_eleitor]">Título de eleitor</label>
                                    {!! Form::text("titulo_eleitor", Session::getOldInput("titulo_eleitor"), array('class' => 'form-control input-sm', 'placeholder' => 'Título de eleitor')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[sessao_titulo_eleitor]">Sessão do título</label>
                                    {!! Form::text("sessao_titulo_eleitor", Session::getOldInput("sessao_titulo_eleitor"), array('class' => 'form-control input-sm', 'placeholder' => 'Sessão do título')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[zona_titulo_eleitor]">Zona do título</label>
                                    {!! Form::text("zona_titulo_eleitor", Session::getOldInput("zona_titulo_eleitor"), array('class' => 'form-control input-sm', 'placeholder' => 'Zona do título')) !!}
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
                                    {!! Form::text("matricula", Session::getOldInput("matricula"), array('class' => 'form-control input-sm', 'placeholder' => 'Matrícula')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[data_admicao]">Data de admição *</label>
                                    {!! Form::text("data_admicao", Session::getOldInput("data_admicao"), array('class' => 'form-control input-sm', 'placeholder' => 'Matrícula')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="servidor[carga_horaria]">Carga horária</label>
                                    {!! Form::text("carga_horaria", Session::getOldInput("carga_horaria"), array('class' => 'form-control input-sm', 'placeholder' => 'Carga horária')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[tipo_vinculo_servidor_id]">Tipo de vínculo *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("tipo_vinculo_servidor_id", (["" => "Selecione o tipo"] + $loadFields['tipovinculo']->toArray()), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[habilitacao_escolaridade_id]">Habilitação\Escolaridade *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("habilitacao_escolaridade_id", (["" => "Selecione"] + $loadFields['habilitacaoescolaridade']->toArray()), null, array()) !!}
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
                                    {!! Form::select("cargos_id", (["" => "Selecione"] + $loadFields['cargo']->toArray()), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="servidor[funcoes_id]">Função *</label>
                                <div class="select">
                                    {{--["" => "Selecione bairro"] + $loadFields['bairro']->toArray()--}}
                                    {!! Form::select("funcoes_id", (["" => "Selecione"] + $loadFields['funcao']->toArray()), null, array()) !!}
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
                                    {!! Form::select("situacao_servidores_id", (["" => "Selecione"] + $loadFields['situacao']->toArray()), null, array()) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim --}}

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('cgm.index') }}">Listar</a>
            </div>
            <!-- Fim Conteúdo -->
        </div>
        <!-- Fim Painel -->
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    --}}{{--Regras adicionais--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/adicional/alphaSpace.js')  }}"></script>
    --}}{{--Regras de validação--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/convenio.js')  }}"></script>--}}
@endsection