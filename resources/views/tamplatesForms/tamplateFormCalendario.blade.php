<div class="block-header">
    <h2>Cadastro de Calendário</h2>
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
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do calendário')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="ano">Ano *</label>
                                {!! Form::text('ano', Session::getOldInput('ano'), array('class' => 'form-control input-sm', 'placeholder' => 'Ano do calendário')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="duracoes_id">Duração *</label>
                            <div class="select">
                                {!! Form::select("duracoes_id", ["" => "Selecione"] + $loadFields['duracao']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="data_inicial">Data inicial *</label>
                                {!! Form::text('data_inicial', Session::getOldInput('data_inicial'), array('class' => 'form-control input-sm datepicker date', 'placeholder' => 'Data inicial')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="data_final">Data final *</label>
                                {!! Form::text('data_final', Session::getOldInput('data_final'), array('class' => 'form-control input-sm datepicker', 'placeholder' => 'Data final')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="data_resultado_final">Data de resultado final *</label>
                                {!! Form::text('data_resultado_final', Session::getOldInput('data_resultado_final'), array('class' => 'form-control input-sm datepicker', 'placeholder' => 'Data de resultado final')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="dias_letivos">Dias letivos</label>
                                {!! Form::text('dias_letivos', Session::getOldInput('dias_letivos'), array('class' => 'form-control input-sm', 'readonly' => 'readonly')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="semanas_letivas">Semanas letivas</label>
                                {!! Form::text('semanas_letivas', Session::getOldInput('semanas_letivas'), array('class' => 'form-control input-sm', 'readonly' => 'readonly')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="status_id">Status *</label>
                            <div class="select">
                                {!! Form::select("status_id", ["" => "Selecione"] + $loadFields['status']->toArray(), null, array('class'=> 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('calendario.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>

    --}}{{--Regras de validação--}}{{----}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/calendario.js')  }}"></script>
@endsection