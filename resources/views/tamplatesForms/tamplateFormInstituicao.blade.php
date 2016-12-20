<div class="block-header">
    <h2>Instituição</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <!-- Painel -->
        <div role="tabpanel">
            <!-- Guias -->
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#infoBasicas" aria-controls="infoBasicas" role="tab" data-toggle="tab">Dados Gerais</a>
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
                                    <label for="nome">Nome</label>
                                    {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="cnpj">CNPJ</label>
                                    {!! Form::text('cnpj', Session::getOldInput('cnpj'), array('class' => 'form-control input-sm', 'placeholder' => 'CNPJ')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="insc_municipal">Inscrição municipal *</label>
                                    {!! Form::text('insc_municipal', Session::getOldInput('insc_municipal'), array('class' => 'form-control input-sm', 'placeholder' => 'Inscrição municipal')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="insc_estadual">Inscrição estadual *</label>
                                    {!! Form::text('insc_estadual', Session::getOldInput('insc_estadual'), array('class' => 'form-control input-sm', 'placeholder' => 'Inscrição estadual')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--#2--}}
                <div role="tabpanel" class="tab-pane" id="endereco">
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <div class="fg-line">
                                <div class="fg-line">
                                    <label for="endereco[logradouro]">Logradouro *</label>
                                    {!! Form::text("endereco[logradouro]", Session::getOldInput("endereco['logradouro']"), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail')) !!}
                                </div>
                            </div>
                        </div>
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
                        <div class="form-group col-sm-3">
                            <div class=" fg-line">
                                <label for="endereco['estado_id']">Estado *</label>
                                @if(isset($model->endereco->bairro->cidade->estado->id))
                                    <div class="select">
                                        {!! Form::select("estado_id", $loadFields['estado'], $model->endereco->bairro->cidade->estado->id, array('class' => 'form-control', 'id' => 'estado')) !!}
                                    </div>
                                @else
                                    <div class="select">
                                        {!! Form::select("estado_id", $loadFields['estado'], array('class' => 'form-control', 'id' => 'estado')) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class=" fg-line">
                                <label for="cidade_id">Cidade *</label>
                                @if(isset($model->endereco->bairro->cidade->id))
                                    <div class="select">
                                        {!! Form::select("cidade_id", array($model->endereco->bairro->cidade->id => $model->endereco->bairro->cidade->nome), $model->endereco->bairro->cidade->id, array('class' => 'form-control', 'id' => 'cidade')) !!}
                                    </div>
                                @else
                                    <div class="select">
                                        {!! Form::select('cidade_id', array(), Session::getOldInput('cidade_id'), array('class' => 'form-control', 'id' => 'cidade')) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-5">
                            <div class=" fg-line">
                                <label for="endereco[bairro_id]">Bairro *</label>
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
            <!-- Conteúdo -->
            </div>
        </div>
            {{--<label>Função de professor?</label>
            <div class="row">
                <div class="form-group col-md-4">
                    <div class="fg-line">
                    <label for="funcao_professor" class="checkbox checkbox-inline m-r-20">
                        {!! Form::hidden('funcao_professor', 0) !!}
                        {!! Form::checkbox('funcao_professor', 1, null, ['id' => 'funcao_professor']) !!}
                        <i class="input-helper"></i>
                        Ativo
                    </label>
                </div>
                </div>
            </div>--}}

        <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    --}}{{--Regras adicionais--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/adicional/alphaSpace.js')  }}"></script>
    --}}{{--Regras de validação--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/convenio.js')  }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/instituicao.js')  }}"></script>

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
                    url: '{{ route('escola.findCidade')  }}',
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
                    url: '{{ route('escola.findBairro')  }}',
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