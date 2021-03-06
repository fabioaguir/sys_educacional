<div class="block-header">
    <h2>Cadastro de Pessoa Jurídica</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <!-- Campo que recebe o id do model em questão, possibilitando a edição do cadastro sem que haja conflito com o
        CPF que foi cadastrado no ato do cadastro de pessoa jurídica -->
        <input type="hidden" id="idPessoaJuridica" value="{{ isset($model->id) ? $model->id : null }}">

        <!-- Painel -->
        <div role="tabpanel">
            <!-- Guias -->
            <ul id="tabs" class="tab-nav" role="tablist" data-tab-color="cyan">
                <li class="active"><a href="#infoBasicas" aria-controls="infoBasicas" role="tab" data-toggle="tab">Informações Básicas</a></li>
                <li><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
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
                                    {!! Form::text('cnpj', Session::getOldInput('cnpj'), array('id' => 'cnpj', 'class' => 'form-control input-sm', 'placeholder' => 'CNPJ')) !!}
                                </div>
                            </div>
                        </div>
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
                                    {!! Form::text('nome_complemento', Session::getOldInput('nome_complemento'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome complemento')) !!}
                                </div>
                            </div>
                        </div>
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
                                <label for="tipo_empresa_id">Tipo empresa *</label>
                                <div class="select">
                                {!! Form::select("tipo_empresa_id", (["" => "Selecione tipo"] + $loadFields['tipoempresa']->toArray()), null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class=" fg-line">
                                <label for="cgm_municipio_id">CGM do município *</label>
                                <div class="select">
                                    {!! Form::select('cgm_municipio_id', ["" => "Selecion"] + $loadFields['cgmmunicipio']->toArray(), null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="inscricao_estadual">Inscrição estadual</label>
                                    {!! Form::text('inscricao_estadual', Session::getOldInput('inscricao_estadual'), array('class' => 'form-control input-sm', 'placeholder' => 'Inscricao Estadual')) !!}
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
                                        {!! Form::text('telefone[nome]', $model->telefone->first()->nome ?? '', array('id' => 'telefone', 'class' => 'form-control input-sm')) !!}
                                    @else
                                        {!! Form::text('telefone[nome]', Session::getOldInput('telefone[nome]'), array('id' => 'telefone', 'class' => 'form-control input-sm')) !!}
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
                                <label for="endereco[estado_id]">Estado *</label>
                                <div class="select">
                                    @if(isset($model->endereco->bairro->cidade->estado->id))
                                        <div class="select">
                                            {!! Form::select("endereco[estado_id]", (["" => "Selecione"] + $loadFields['estado']->toArray()), $model->endereco->bairro->cidade->estado->id, array('class' => 'form-control', 'id' => 'estado')) !!}
                                        </div>
                                    @else
                                        <div class="select">
                                            {!! Form::select("endereco[estado_id]", (["" => "Selecione"] + $loadFields['estado']->toArray()), null,array('class' => 'form-control', 'id' => 'estado')) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco[cidade_id]">Cidade *</label>
                                <div class="select">
                                    @if(isset($model->endereco->bairro->cidade->id))
                                        <div class="select">
                                            {!! Form::select("endereco[cidade_id]", array($model->endereco->bairro->cidade->id => $model->endereco->bairro->cidade->nome), $model->endereco->bairro->cidade->id, array('class' => 'form-control', 'id' => 'cidade')) !!}
                                        </div>
                                    @else
                                        <div class="select">
                                            {!! Form::select('endereco[cidade_id]', array(), Session::getOldInput('cidade_id'), array('class' => 'form-control', 'id' => 'cidade')) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="endereco[bairro_id]">Bairro *</label>
                                <div class="select">
                                    @if(isset($model->endereco->bairro->id))
                                        <div class="select">
                                            {!! Form::select("endereco[bairro_id]", array($model->endereco->bairro->id => $model->endereco->bairro->nome), $model->endereco->bairro->id, array('class' => 'form-control', 'id' => 'bairro')) !!}
                                        </div>
                                    @else
                                        <div class="select">
                                            {!! Form::select("endereco[bairro_id]", array(), Session::getOldInput('bairro'),array('class' => 'form-control', 'id' => 'bairro')) !!}
                                        </div>
                                    @endif
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
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/cnpj.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/dateBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/pessoaJuridica.js')  }}"></script>

    {{-- MASCARAS --}}
    <script type="text/javascript">
        $(document).ready(function() {
            //$('#cpf').mask('000.000.000-00', {reverse: true});
            $('#telefone').mask('(00) 00000-0000');
            $('#cep').mask('00.000-000');
        });

        $( "#formPessoaJuridica" ).submit(function() {
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