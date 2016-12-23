<div class="block-header">
    <h2>Cadastro de Alunos</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">

                <!-- Painel -->
                <div role="tabpanel">
                    <!-- Guias -->
                    <ul class="tab-nav" role="tablist">
                        <li class="active"><a href="#infoBasicas" aria-controls="dadosPessoais" role="tab" data-toggle="tab">Dados Pessoais</a>
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
                        <div role="tabpanel" class="tab-pane active" id="dadosPessoais">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="nome">Nome *</label>
                                            {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do Cargo')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="codigo">Código *</label>
                                            {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do Cargo')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="codigo">INEP *</label>
                                            {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do Cargo')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="codigo">NIS *</label>
                                            {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do Cargo')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--#1--}}
                        {{--#2--}}
                        <div role="tabpanel" class="tab-pane active" id="documentacao">
                        </div>
                        {{--#2--}}
                        {{--#3--}}
                        <div role="tabpanel" class="tab-pane active" id="documentacao">
                        </div>
                        {{--#3--}}

                    </div>
                    <!-- Conteúdo -->
                </div>
                <!-- Painel -->
                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('aluno.index') }}">Voltar</a>
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
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/cargos.js')  }}"></script>
@endsection