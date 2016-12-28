<div class="block-header">
    <h2>Cadastro de Período de Avalição</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        {{--<input type="hidden" id="idPessoaFisica" value="{{ isset($model->id) ? $model->id : null }}">--}}

        <div class="row">
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="data_inicial">Data Inicial *</label>
                        {!! Form::text('data_inicial', Session::getOldInput('data_inicial'), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data Inicial')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="data_final">Data Final *</label>
                        {!! Form::text('data_final', Session::getOldInput('data_final'), array('class' => 'form-control input-sm date-picker', 'placeholder' => 'Data Final')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="dias_letivos">Dias letivo</label>
                        {!! Form::text('dias_letivos', Session::getOldInput('dias_letivos'), array('class' => 'form-control input-sm', 'placeholder' => 'Dias Letivo')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="semanas_letivas">Semanas letiva</label>
                        {!! Form::text('semanas_letivas', Session::getOldInput('semanas_letivas'), array('class' => 'form-control input-sm', 'placeholder' => 'Semanas Letiva')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="dias_letivos">Total de dias letivo</label>
                        {!! Form::text('total_dias_letivos', Session::getOldInput('total_dias_letivos'), array('class' => 'form-control input-sm', 'placeholder' => 'Total de Dias')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="total_semanas_letivas">Total de semanas letiva</label>
                        {!! Form::text('total_semanas_letivas', Session::getOldInput('total_semanas_letivas'), array('class' => 'form-control input-sm', 'placeholder' => 'Total de Semanas')) !!}
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
        <a class="btn btn-primary btn-sm m-t-10" href="{{ route('periodoAvaliacao.index') }}">Voltar</a>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/dateBr.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/periodoAvaliacao.js')  }}"></script>
@endsection