<div class="block-header">
    <h2>Cadastro de Modalidades de Ensino</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <input type="hidden" id="idModalidadeEnsino" value="{{ isset($model->id) ? $model->id : null }}">

            <div class="row">
                <div class="form-group col-md-4">
                    <div class="fg-line">
                        <div class="fg-line">
                            <label for="nome">Nome *</label>
                            {!! Form::text('nome', Session::getOldInput('nome'), array('id' => 'modalidadeNome', 'class' => 'form-control input-sm', 'placeholder' => 'Nome da modalidade')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <div class="fg-line">
                        <div class="fg-line">
                            <label for="codigo">Código *</label>
                            {!! Form::text('codigo', Session::getOldInput('codigo'), array('id' => 'modalidadeCodigo', 'class' => 'form-control input-sm', 'placeholder' => 'Código')) !!}
                        </div>
                    </div>
                </div>
            </div>
        <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
        <a class="btn btn-primary btn-sm m-t-10" href="{{ route('modalidadeEnsino.index') }}">Voltar</a>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/modalidadeEnsino.js')  }}"></script>
@endsection