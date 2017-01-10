<div class="block-header">
    <h2>Cadastro de Cursos</h2>
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
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do Curso')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do Curso')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="nivel_ensino_id">Nível de Ensino *</label>
                            <div class="select">
                                {!! Form::select("nivel_ensino_id", ["" => "Selecione um nível de ensino"] + $loadFields['nivelensino']->toArray(), null, array('class'=> 'form-control')) !!}
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
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/curso.js')  }}"></script>
@endsection