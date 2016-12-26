<div class="block-header">
    <h2>Cadastro de Função</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        {{--<div role="tabpanel">--}}
            <div class="row">
                <div class="form-group col-md-4">
                    <div class="fg-line">
                        <div class="fg-line">
                            <label for="nome">Nome *</label>
                            {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da função')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <div class="fg-line">
                        <div class="fg-line">
                            <label for="sigla">Sigla</label>
                            {!! Form::text('sigla', Session::getOldInput('sigla'), array('class' => 'form-control input-sm', 'placeholder' => 'Sigla da função')) !!}
                        </div>
                    </div>
                </div>
            </div>

            <label>Função de professor?</label>
            <div class="row">
                <div class="form-group col-md-4">
                    <div class="fg-line">
                    <label for="funcao_professor" class="checkbox checkbox-inline m-r-20">
                        {!! Form::hidden('funcao_professor', 0) !!}
                        {!! Form::checkbox('funcao_professor', 1, null, ['id' => 'funcao_professor']) !!}
                        <i class="input-helper"></i>
                        Ativo
                    </label>
                </div>
                </div>
            </div>

        {{--</div>--}}
        <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
        <a class="btn btn-primary btn-sm m-t-10" href="{{ route('funcao.index') }}">Voltar</a>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/funcao.js')  }}"></script>

    <script type="text/javascript">
        //Incio - Retorno de cidades associadas aos estados
        $(document).on('change', "#estado", function () {

            //Removendo as cidades
            $('#cidade option').remove();

            //Recuperando o estado
            var estado = $(this).val();

            if (estado !== "") {
                var dados = {
                    'id' : estado
                };

                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('pessoaFisica.findCidade')  }}',
                    data: dados,
                    datatype: 'json',
                    headers: {
                        'X-CSRF-TOKEN' : '{{  csrf_token() }}'
                    },
                }).done(function (json) {
                    var option = "";

                    option += '<option value="">Selecione um municipio</option>';
                    for (var i = 0; i < json.length; i++) {
                        option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                    }

                    $('#cidade option').remove();
                    $('#cidade').append(option);
                });
            }
        });
        //Fim - Retorno de cidades associadas ao estados

        //Incio - Retorno de cidades associadas aos estados
        $(document).on('change', "#cidade", function () {

            //Removendo as cidades
            $('#bairro option').remove();

            //Recuperando o estado
            var estado = $(this).val();

            if (estado !== "") {
                var dados = {
                    'id' : estado
                };

                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('pessoaFisica.findBairro')  }}',
                    data: dados,
                    datatype: 'json',
                    headers: {
                        'X-CSRF-TOKEN' : '{{  csrf_token() }}'
                    },
                }).done(function (json) {
                    var option = "";

                    option += '<option value="">Selecione um municipio</option>';
                    for (var i = 0; i < json.length; i++) {
                        option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                    }

                    $('#bairro option').remove();
                    $('#bairro').append(option);
                });
            }
        });
        //Fim - Retorno de cidades associadas ao estados
    </script>

@endsection