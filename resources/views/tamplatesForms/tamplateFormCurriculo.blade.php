<div class="block-header">
    <h2>Cadastro de Currículos</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="nome">Nome *</label>
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do Currículo')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="curso_id">Curso *</label>
                            <div class="select">
                                {!! Form::select("curso_id", ["" => "Selecione um curso"] + $loadFields['curso']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do Currículo')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="disciplina_global_id">Disciplina Global</label>
                                <div class="select">
                                    {!! Form::select("disciplina_global_id", ["" => "Selecione uma disciplina"] + $loadFields['disciplina']->toArray(), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="frequencia_id">Frequência</label>
                                <div class="select">
                                    {!! Form::select("frequencia_id", ["" => "Selecione uma frequência"] + $loadFields['frequencia']->toArray(), null, array('class'=> 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="controle_frequencia_id">Controle de Frequência</label>
                            <div class="select">
                                {!! Form::select("controle_frequencia_id", ["" => "Selecione um controle de frequência"] + $loadFields['controlefrequencia']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="serie_inicial_id">Serie Inicial *</label>
                            <div class="select">
                                {!! Form::select("serie_inicial_id", ["" => "Selecione uma Série"] + $loadFields['serie']->toArray(),
                                isset($serieInicial->id) ? $serieInicial->id : null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="serie_final_id">Serie Final *</label>
                            <div class="select">
                                {!! Form::select("serie_final_id", ["" => "Selecione uma Série"] + $loadFields['serie']->toArray(),
                                 isset($serieFinal->id) ? $serieFinal->id : null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>Ativo:</label>
                        <div class="form-group">
                            <label for="status" class="checkbox checkbox-inline m-r-20">
                                {!! Form::hidden('ativo', 0) !!}
                                {!! Form::checkbox('ativo', 1, null, ['id' => 'ativo']) !!}
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <div class=" fg-line">
                            <label for="observacao">Observação</label>
                            {!! Form::textarea('observacao', Session::getOldInput('observacao'),
                                array('class' => 'form-control input-sm', 'placeholder' => 'Adicione uma observação ao currículo')) !!}
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('curriculo.index') }}">Voltar</a>
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
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/curriculo.js')  }}"></script>

    {{--<script type="text/javascript">
        $(document).on('click', '#ativo', function () {
            if($(this).is(':checked')) {
                swal("Marcando esse currículo como ativo, estará automaticamente desativando o atual ativo.", "Click no botão abaixo!", "warning");
            }
        });
    </script>--}}
@endsection