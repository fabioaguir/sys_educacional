<div class="block-header">
    <h2>Cadastro de Procedimento de avaliação</h2>
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
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do procedimento')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="frequencia_minima_avaliacao">F. mínima para aprovação *</label>
                                {!! Form::text('frequencia_minima_avaliacao', Session::getOldInput('frequencia_minima_avaliacao'), array('class' => 'form-control input-sm', 'placeholder' => 'Frequência mínima')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do procedimento')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('procedimentoAvaliacao.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>

    {{-- regras adicionais --}}
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>

    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/procedimentoAvaliacao.js')  }}"></script>
@endsection