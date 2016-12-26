{{--{{ dd($model) }}--}}

<div class="block-header">
    <h2>Cadastro de Alunos</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <input type="hidden" id="idModalidadeEnsino" value="{{ isset($model->id) ? $model->id : null }}">

        <div class="row">
            <div class="col-md-12">

                <!-- Painel -->
                <div role="tabpanel">
                    <!-- Guias -->
                    <ul id="tabs" class="tab-nav" role="tablist">
                        <li class="active"><a href="#dadosPessoais" aria-controls="dadosPessoais" role="tab" data-toggle="tab">Dados Pessoais</a>
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
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="num_inep">INEP *</label>
                                            {!! Form::text('num_inep', Session::getOldInput('num_inep'), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="num_nis">NIS *</label>
                                            {!! Form::text('num_nis', Session::getOldInput('num_nis'), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[nome]">Nome *</label>
                                            {!! Form::text('cgm[nome]', Session::getOldInput('cgm[nome]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome completo')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="codigo">Código *</label>
                                            {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do aluno')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[data_nascimento]">Data de Nascimento *</label>
                                            {!! Form::text('cgm[data_nascimento]', Session::getOldInput('cgm[data_nascimento]'), array('class' => 'form-control input-sm ', 'placeholder' => 'Data de Nascimento')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class=" fg-line">
                                        <label for="cgm[sexo_id]">Gênero *</label>
                                        <div class="select">
                                            {!! Form::select('cgm[sexo_id]', (["" => "Selecione Gênero"] + $loadFields['sexo']->toArray()), null, array('class'=> 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[cpf]">CPF *</label>
                                            {!! Form::text('cgm[cpf]', Session::getOldInput('cgm[cpf]'), array('id' => 'cpf', 'class' => 'form-control input-sm', 'placeholder' => 'Nome completo do pai')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[rg]">RG *</label>
                                            {!! Form::text('cgm[rg]', Session::getOldInput('cgm[rg]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome completo da mãe')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[pai]">Nome Pai</label>
                                            {!! Form::text('cgm[pai]', Session::getOldInput('cgm[pai]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome completo do pai')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[mae]">Nome Mãe</label>
                                            {!! Form::text('cgm[mae]', Session::getOldInput('cgm[mae]'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome completo da mãe')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="telefone[nome]">Telefone</label>
                                            @if (isset($model))
                                                {!! Form::text('telefone[nome]', $model->cgm->telefone->first()->nome ?? '', array('class' => 'form-control input-sm', 'placeholder' => 'Telefone do responsável')) !!}
                                            @else
                                                {!! Form::text('telefone[nome]', Session::getOldInput('telefone[nome]'), array('class' => 'form-control input-sm', 'placeholder' => 'Telefone do responsável')) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[email]">E-mail</label>
                                            {!! Form::text('cgm[email]', Session::getOldInput('cgm[email]'), array('class' => 'form-control input-sm', 'placeholder' => 'Endereço eletrônico')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class=" fg-line">
                                        <label for="cgm[nacionalidade_id]">Nacionalidade *</label>
                                        <div class="select">
                                            {!! Form::select('cgm[nacionalidade_id]', (["" => "Selecione nacionalidade"] + $loadFields['nacionalidade']->toArray()), null, array('class'=> 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[naturalidade]">Naturalidade</label>
                                            {!! Form::text('cgm[naturalidade]', Session::getOldInput('cgm[naturalidade]'), array('class' => 'form-control input-sm', 'placeholder' => 'Cidade natal')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--#1--}}
                        {{--#2--}}
                        <div role="tabpanel" class="tab-pane" id="endereco">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][logradouro]">Logradouro *</label>
                                            {!! Form::text("cgm[endereco][logradouro]", Session::getOldInput("cgm[endereco][logradouro]"), array('class' => 'form-control input-sm', 'placeholder' => 'Logradouro')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][numero]">Número *</label>
                                            {!! Form::text("cgm[endereco][numero]", Session::getOldInput("cgm[endereco][numero]"), array('class' => 'form-control input-sm', 'placeholder' => 'Número')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][complemento]">Complemento</label>
                                            {!! Form::text("cgm[endereco][complemento]", Session::getOldInput("cgm[endereco][complemento]"), array('class' => 'form-control input-sm', 'placeholder' => 'Ponto de referência')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="cgm[endereco][cep]">CEP</label>
                                            {!! Form::text("cgm[endereco][cep]", Session::getOldInput("cgm[endereco][cep]"), array('class' => 'form-control input-sm', 'placeholder' => 'CEP')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cgm[endereco][zona_id]">Zona</label>
                                        <div class="select">
                                            {!! Form::select("cgm[endereco][zona_id]", (["" => "Selecione zona"] + $loadFields['zona']->toArray()), null, array('class' => 'form-control Form::select')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cgm[endereco][estado_id]">Estado *</label>
                                        <div class="select">
                                            {!! Form::select("cgm[endereco][estado_id]", (["" => "Selecione estado"] + $loadFields['estado']->toArray()), null, array('class' => 'form-control Form::select', 'id' => 'estado')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cgm[endereco][cidade_id]">Cidade *</label>
                                        <div class="select">
                                            {!! Form::select("cgm[endereco][cidade_id]", (["" => "Selecione cidade"] + $loadFields['cidade']->toArray()), null, array('class' => 'form-control Form::select', 'id' => 'cidade')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class=" fg-line">
                                        <label for="cgm[endereco][bairro_id]">Bairro *</label>
                                        <div class="select">
                                            {!! Form::select("cgm[endereco][bairro_id]", ["" => "Selecione bairro"], null, array('class' => 'form-control Form::select', 'id' => 'bairro')) !!}
                                        </div>
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
{{--</div>--}}

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
    </script>
@endsection