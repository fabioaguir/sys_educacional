<div class="block-header">
    <h2>Cadastro de Período</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        <div class="row">
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="nome">Nome *</label>
                        {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="abreviatura">Abreviatura *</label>
                        {!! Form::text('abreviatura', Session::getOldInput('abreviatura'), array('class' => 'form-control input-sm', 'placeholder' => 'Abreviatura')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="soma_carga_horaria">Soma Carga Horária</label>
                        {!! Form::text('soma_carga_horaria', Session::getOldInput('soma_carga_horaria'), array('class' => 'form-control input-sm', 'placeholder' => 'Soma Carga Horária')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="ordenacao">Ordenação</label>
                        {!! Form::text('ordenacao', Session::getOldInput('ordenacao'), array('class' => 'form-control input-sm', 'placeholder' => 'Ordenação')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <div class=" fg-line">
                    <label for="controle_frequencia">Controle de Frequência *</label>
                    <div class="select">
                        {!! Form::select('controle_frequencia', (["" => "Selecione gênero"] + $loadFields['controlefrequencia']->toArray()), null, array('class'=> 'form-control', 'placeholder' => 'Controle de Frequência')) !!}
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
        <a class="btn btn-primary btn-sm m-t-10" href="{{ route('periodo.index') }}">Voltar</a>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/dateBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/periodo.js')  }}"></script>
@endsection