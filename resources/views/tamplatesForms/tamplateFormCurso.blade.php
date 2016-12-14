<div class="block-header">
    <h2>Cadastro de Cursos</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código da Disciplina')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="nome">Nome *</label>
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da Disciplina')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 m-b-15">
                        {{--<div class="fg-line">--}}
                            <label for="nivel_curso_id">Nível Curso</label>
                            <div class="select">
                                {!! Form::select("nivel_curso_id", ["" => "Selecione"] + $loadFields['nivelcurso']->toArray(), null, array('class'=> 'chosen')) !!}
                            </div>
                        {{-- </div>--}}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class=" fg-line">
                            <label for="regime_curso_id">Regime Curso</label>
                            <div class="select">
                                {!! Form::select("regime_curso_id", ["" => "Selecione"] + $loadFields['regimecurso']->toArray(), null, array('class'=> 'chosen')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class=" fg-line">
                            <label for="tipo_curso_id">Tipo Curso</label>
                            <div class="select">
                                {!! Form::select("tipo_curso_id", ["" => "Selecione"] + $loadFields['tipocurso']->toArray(), null, array('class'=> 'chosen')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('curso.index') }}">Voltar</a>
            </div>
        </div>
    </div>
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