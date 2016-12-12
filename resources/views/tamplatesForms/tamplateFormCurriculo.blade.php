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
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da Currículo')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código do Currículo')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class=" fg-line">
                            <label for="curso_id">Curso</label>
                            <div class="select">
                                {!! Form::select("curso_id", ["" => "Selecione"] + $loadFields['curso']->toArray(), null, array('class'=> 'chosen')) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <label>Ativo:</label>
                    <div class="form-group">
                        <label for="status" class="checkbox checkbox-inline m-r-20">
                            {!! Form::hidden('ativo', 0) !!}
                            {!! Form::checkbox('ativo', 1, null, ['id' => 'ativo']) !!}
                            <i class="input-helper"></i>
                        </label>
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
    <script type="text/javascript">
        $(document).on('click', '#ativo', function () {
            if($(this).is(':checked')) {
                swal("Marcando esse currículo como ativo, estará automaticamente desativando o atual ativo.", "Click no botão abaixo!", "warning");
            }
        });
    </script>
    {{--Mensagens personalizadas--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    --}}{{--Regras adicionais--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/adicional/alphaSpace.js')  }}"></script>
    --}}{{--Regras de validação--}}{{--
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/convenio.js')  }}"></script>--}}
@endsection