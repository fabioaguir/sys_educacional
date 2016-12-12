<div class="block-header">
    <h2>Cadastro de Pessoa Jurídica</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <!-- Painel -->
        <div role="tabpanel">
            <!-- Guias -->
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#infoBasicas" aria-controls="infoBasicas" role="tab" data-toggle="tab">Informações Básicas</a>
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
                                    <label for="cnpj *">CNPJ *</label>
                                    {!! Form::text('cnpj', Session::getOldInput('cnpj'), array('class' => 'form-control input-sm', 'placeholder' => 'CNPJ')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class=" fg-line">
                                <label for="cgm_municipio_id">CGM do município *</label>
                                <div class="select">
                                    {!! Form::select('cgm_municipio_id', ["" => "Selecione nacionalidade"] + $loadFields['cgmmunicipio']->toArray(), null, array('class'=> 'chosen')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="Nome *">Nome</label>
                                    {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome completo')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="nome_complemento">Nome complemento *</label>
                                    {!! Form::date('nome_complemento', null, ['class' => 'form-control input-sm', 'placeholder' => 'Nome complemento']) !!}
                                    {{--{!! Form::text('data_nascimento', Session::getOldInput('data_nascimento'), array('class' => 'form-control input-sm', 'placeholder' => 'Data de Nascimento')) !!}--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="nome_fantasia">Nome fantasia *</label>
                                    {!! Form::text('nome_fantasia', Session::getOldInput('nome_fantasia'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome fantasia')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="tipo_empresa_id">Tipo empresa</label>
                                    {!! Form::text('tipo_empresa_id', Session::getOldInput('tipo_empresa_id'), array('class' => 'form-control input-sm', 'placeholder' => 'Local de Nascimento')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="inscricao_estadual">Inscrição Estadual</label>
                                    {!! Form::text('inscricao_estadual', Session::getOldInput('inscricao_estadual'), array('class' => 'form-control input-sm', 'placeholder' => 'Inscricao Estadual')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="telefone[nome]">Telefones</label>
                                    @if (isset($model))
                                    {!! Form::text('telefone[nome]', $model->telefone->first()->nome ?? '', array('class' => 'form-control input-sm')) !!}
                                    @else
                                    {!! Form::text('telefone[nome]', Session::getOldInput('telefone[nome]'), array('class' => 'form-control input-sm')) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm m-t-10">Adicionar</button>
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
                <div role="tabpanel" class="tab-pane" id="endereco">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[logradouro]">Logradouro *</label>
                                    {!! Form::text("endereco[logradouro]", Session::getOldInput("endereco['logradouro']"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[numero]">Número *</label>
                                    {!! Form::text("endereco[numero]", Session::getOldInput("endereco[numero]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[complemento]">Complemento</label>
                                    {!! Form::text("endereco[complemento]", Session::getOldInput("endereco[complemento]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[cep]">CEP</label>
                                    {!! Form::text("endereco[cep]", Session::getOldInput("endereco[cep]"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco['estado_id']">Estado *</label>
                                <div class="select">
                                    {!! Form::select("endereco[estado_id]", (["" => "Selecione grau"] + $loadFields['estado']->toArray()), null, array('id' => 'estado')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco['cidade_id']">Cidade *</label>
                                <div class="select">
                                    {!! Form::select("endereco[cidade_id]", (["" => "Selecione grau"]), null, array('id' => 'cidade')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco[bairro_id]">Bairro *</label>
                                <div class="select">
                                    {!! Form::select("endereco[bairro_id]", ["" => "Selecione bairro"], null, array('id' => 'bairro')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim --}}

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('pessoaJuridica.index') }}">Voltar</a>
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
                    url: '{{ route('pessoaJuridica.findCidade')  }}',
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
                    url: '{{ route('pessoaJuridica.findBairro')  }}',
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