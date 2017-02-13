<div class="block-header">
    <h2>Cadastro de Turmas</h2>
</div>

<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="nome">Nome *</label>
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da Turma')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código da Turma')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class=" fg-line">
                            <label for="aprovacao_automatica">Aprovação Automática ?</label>
                            <div class="select">
                                {!! Form::select("aprovacao_automatica", [0 => "Não", 1 => "Sim"], null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-1">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="vagas">Vagas *</label>
                                {!! Form::text('vagas', Session::getOldInput('vagas'), array('class' => 'form-control input-sm', 'placeholder' => 'Vagas')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="curso_id">Curso *</label>
                            <div class="select">
                                @if(isset($model->curso))
                                    {!! Form::select("curso_id", [$model->curso->id => $model->curso->nome],
                                    null, ['readonly' => 'readonly', 'class'=> 'form-control', 'id' => 'curso']) !!}
                                @else
                                    {!! Form::select("curso_id", ["" => "Selecione um curso"] + $loadFields['curso']->toArray(),
                                    null, ['class'=> 'form-control', 'id' => 'curso']) !!}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="curriculo_id">Currículo *</label>
                            <div class="select">
                                @if(isset($model->curriculo))
                                    {!! Form::select("curriculo_id", [$model->curriculo->id => $model->curriculo->nome], null,
                                    ['readonly' => 'readonly', 'class'=> 'form-control', 'id' => 'curriculo']) !!}
                                @else
                                    {!! Form::select("curriculo_id", [], null, ['class'=> 'form-control', 'id' => 'curriculo']) !!}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="serie_id">Série *</label>
                            <div class="select">
                                @if(isset($model->serie))
                                    {!! Form::select("serie_id", [$model->serie->id => $model->serie->nome], null,
                                    ['readonly' => 'readonly', 'class'=> 'form-control', 'id' => 'serie']) !!}
                                @else
                                    {!! Form::select("serie_id", [], null, ['class'=> 'form-control', 'id' => 'serie']) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="escola_id">Escola *</label>
                            <div class="select">
                                {!! Form::select("escola_id", ["" => "Selecione uma escola"] + $loadFields['escola']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="forma_avaliacao_id">Forma de Avaliação *</label>
                            <div class="select">
                                {!! Form::select("forma_avaliacao_id", ["" => "Selecione uma avaliação"] + $loadFields['formaavaliacao']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="calendario_id">Calendario *</label>
                            <div class="select">
                                {!! Form::select("calendario_id", ["" => "Selecione um calendario"] + $loadFields['calendario']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="tipo_atendimento_id">Tipo de atendimento *</label>
                            <div class="select">
                                {!! Form::select("tipo_atendimento_id", ["" => "Selecione um tipo"] + $loadFields['tipoatendimento']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="dependencia_id">Dependência *</label>
                            <div class="select">
                                {!! Form::select("dependencia_id", ["" => "Selecione uma dependência"] + $loadFields['dependencia']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="turno_id">Turno *</label>
                            <div class="select">
                                {!! Form::select("turno_id", ["" => "Selecione um turno"] + $loadFields['turno']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <div class=" fg-line">
                            <label for="observacao">Observação</label>
                            {!! Form::textarea('observacao', Session::getOldInput('observacao'),
                                array('class' => 'form-control input-sm', 'placeholder' => 'Adicione uma observação a turma')) !!}
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('turma.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>

    {{-- --}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>

    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/turma.js')  }}"></script>
    <script type="text/javascript">
        /*
        * Evento para preencher automaticamete o select de
        * currículo pelo curso escolhido
        */
        $(document).on('change', '#curso', function () {
            //Removendo os currículos
            $('#curriculo option').remove();

            //Recuperando o estado
            var curso = $(this).val();

            // Requisição
            jQuery.ajax({
                type: 'GET',
                url: laroute.route('turma.searchCurriculosByCurso', {'idCurso' : curso}),
                datatype: 'json',
            }).done(function (json) {
                // Html de retorno
                var option = "";

                // option default
                option += '<option value="">Selecione um Currículo</option>';

                // Percorrendo o array
                for (var i = 0; i < json.length; i++) {
                    option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                }

                // Alterando o dom
                $('#curriculo option').remove();
                $('#curriculo').append(option);
            });
        });


        /*
         * Evento para preencher automaticamete o select de
         * séries pelo currículo escolhido
         */
        $(document).on('change', '#curriculo', function () {
            //Removendo os currículos
            $('#serie option').remove();

            //Recuperando o estado
            var curriculo = $(this).val();

            // Requisição
            jQuery.ajax({
                type: 'GET',
                url: laroute.route('turma.searchSeriesByCurriculo', {'idCurriculo' : curriculo}),
                datatype: 'json',
            }).done(function (json) {
                // Html de retorno
                var option = "";

                // option default
                option += '<option value="">Selecione uma Série</option>';

                // Percorrendo o array
                for (var i = 0; i < json.length; i++) {
                    option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                }

                // Alterando o dom
                $('#serie option').remove();
                $('#serie').append(option);
            });
        });
    </script>
@endsection