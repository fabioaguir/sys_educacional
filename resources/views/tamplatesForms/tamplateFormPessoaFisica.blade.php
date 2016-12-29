<div class="block-header">
    <h2>Cadastro de Pessoa Física</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <input type="hidden" id="idPessoaFisica" value="{{ isset($model->id) ? $model->id : null }}">

        <!-- Painel -->
        <div role="tabpanel">
            <!-- Guias -->
            <ul class="tab-nav" role="tablist">
                <li id="informacoesBasicas" class="active"><a href="#infoBasicas" aria-controls="infoBasicas" role="tab" data-toggle="tab">Informações Básicas</a>
                </li>
                <li><a href="#documentacao" aria-controls="documentacao" role="tab" data-toggle="tab">Documentação</a>
                </li>
                <li><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a>
                </li>
            </ul>
            <!-- Fim Guias -->

            <!-- Conteúdo -->
            <div class="tab-content">
                {{--#1--}}
                <div role="tabpanel" class="tab-pane active" id="infoBasicas">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="nome">Nome *</label>
                                    {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome completo')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class=" fg-line">
                                <label for="sexo_id">Sexo *</label>
                                <div class="select">
                                    {!! Form::select('sexo_id', (["" => "Selecione gênero"] + $loadFields['sexo']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="data_nascimento">Data de Nascimento *</label>
                                    {!! Form::text('data_nascimento', Session::getOldInput('data_nascimento'), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de nascimento')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="data_falecimento">Data de Falecimento</label>
                                    {!! Form::text('data_falecimento', Session::getOldInput('data_falecimento'), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de falecimento')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class=" fg-line">
                                <label for="nacionalidade">Nacionalidade *</label>
                                <div class="select">
                                    {!! Form::select('nacionalidade_id', (["" => "Selecione nacionalidade"] + $loadFields['nacionalidade']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-offset-1 col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="naturalidade">Naturalidade</label>
                                    {!! Form::text('naturalidade', Session::getOldInput('naturalidade'), array('class' => 'form-control input-sm', 'placeholder' => 'Cidade onde nasceu')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="inscricao_estadual">Inscrição Estadual</label>
                                    {!! Form::text('inscricao_estadual', Session::getOldInput('inscricao_estadual'), array('class' => 'form-control input-sm', 'placeholder' => 'Inscricao estadual')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <div class=" fg-line">
                                <label for="cgm_municipio_id">CGM do Município *</label>
                                <div class="select">
                                    {!! Form::select('cgm_municipio_id', (["" => "Selecione"] + $loadFields['cgmmunicipio']->toArray()), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="telefone[nome]">Telefone</label>
                                    @if (isset($model))
                                    {!! Form::text('telefone[nome]', $model->telefone->first()->nome ?? '', array('id' => 'telefone', 'class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                    @else
                                    {!! Form::text('telefone[nome]', Session::getOldInput('telefone[nome]'), array('id' => 'telefone', 'class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--<button class="btn btn-primary btn-sm m-t-10">Adicionar</button>--}}
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="email">E-mail</label>
                                    {!! Form::text('email', Session::getOldInput('email'), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
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
                                    <label for="pai">Nome Pai *</label>
                                    {!! Form::text('pai', Session::getOldInput('pai'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do pai completo')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="mae">Nome Mãe *</label>
                                    {!! Form::text('mae', Session::getOldInput('mae'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da mãe completo')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cpf">CPF *</label>
                                    {!! Form::text('cpf', Session::getOldInput('cpf'), array('id' => 'cpf', 'class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="rg">RG *</label>
                                    {!! Form::text('rg', Session::getOldInput('rg'), array('class' => 'form-control input-sm', 'placeholder' => 'Registro geral')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="orgao_emissor">Orgão Emissor *</label>
                                    {!! Form::text('orgao_emissor', Session::getOldInput('orgao_emissor'), array('class' => 'form-control input-sm', 'placeholder' => 'Orgão emissor')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="data_expedicao">Data de expedição *</label>
                                    {!! Form::text('data_expedicao', Session::getOldInput('data_expedicao'), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data de expedição')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="estado_civil_id">Estado Civil *</label>
                                <div class="select">
                                    {!! Form::select('estado_civil_id', (["" => "Selecione estado"] + $loadFields['estadocivil']->toArray()), null, array('class' => 'Form::select form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="escolaridade_id">Escolaridade *</label>
                                <div class="select">
                                    {!! Form::select('escolaridade_id', (["" => "Selecione grau"] + $loadFields['escolaridade']->toArray()), null, array('class' => 'Form::select form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="num_cnh">Número da CNH</label>
                                    {!! Form::text('num_cnh', Session::getOldInput('num_cnh'), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <div class=" fg-line">
                                <label for="cnh_categoria_id">Categoria CNH</label>
                                <div class="select">
                                    {!! Form::select('cnh_categoria_id', (["" => "Selecione categoria"] + $loadFields['categoriacnh']->toArray()), null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-offset-2 col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="data_vencimento_cnh">Data Vencimento</label>
                                    {!! Form::text('data_vencimento_cnh', Session::getOldInput('data_vencimento_cnh'), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data vencimento CNH')) !!}
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
                                    {!! Form::text("endereco[logradouro]", Session::getOldInput("endereco['logradouro']"), array('class' => 'form-control input-sm', 'placeholder' => 'Logradouro')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[numero]">Número *</label>
                                    {!! Form::text("endereco[numero]", Session::getOldInput("endereco[numero]"), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[complemento]">Complemento</label>
                                    {!! Form::text("endereco[complemento]", Session::getOldInput("endereco[complemento]"), array('class' => 'form-control input-sm', 'placeholder' => 'Ponto de referência')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[cep]">CEP</label>
                                    {!! Form::text("endereco[cep]", Session::getOldInput("endereco[cep]"), array('id' => 'cep', 'class' => 'form-control input-sm', 'placeholder' => 'CEP')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco['estado_id']">Estado *</label>
                                <div class="select">
                                    {!! Form::select("endereco[estado_id]", (["" => "Selecione estado"] + $loadFields['estado']->toArray()), null, array('class' => 'Form::select form-control', 'id' => 'estado')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco['cidade_id']">Cidade *</label>
                                <div class="select">
                                    {!! Form::select("endereco[cidade_id]", (["" => "Selecione cidade"] + $loadFields['cidade']->toArray()), null, array('class' => 'Form::select form-control', 'id' => 'cidade')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco[bairro_id]">Bairro *</label>
                                <div class="select">
                                    {!! Form::select("endereco[bairro_id]", ["" => "Selecione bairro"], null, array('class' => 'Form::select form-control', 'id' => 'bairro')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim --}}

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('pessoaFisica.index') }}">Voltar</a>
            </div>
            <!-- Fim Conteúdo -->
        </div>
        <!-- Fim Painel -->
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/unique.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/dateBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/cpfBR.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/pessoaFisica.js')  }}"></script>

    {{-- MASCARAS --}}
    <script type="text/javascript">
        $(document).ready(function() {
            //$('#cpf').mask('000.000.000-00', {reverse: true});
            $('#telefone').mask('(00) 00000-0000');
            $('#cep').mask('00.000-000');
        });

        $( "#formPessoaFisica" ).submit(function() {
            //$('#cpf').unmask();
            $('#telefone').unmask();
            $('#cep').unmask();
        });
    </script>

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