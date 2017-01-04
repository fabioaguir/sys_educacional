<div class="block-header">
    <h2>Cadastro de Formas de Avaliações</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="row" style="margin-bottom: 2%;">
                    <div class="form-group col-md-6">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="nome">Nome *</label>
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da Forma de Avaliação')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="codigo">Código *</label>
                                {!! Form::text('codigo', Session::getOldInput('codigo'), array('class' => 'form-control input-sm', 'placeholder' => 'Código da Forma de Avaliação')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class=" fg-line">
                            <label for="tipo_resultado_id">Tipo de Resultado *</label>
                            <div class="select">
                                @if(isset($model))
                                    {!! Form::select("tipo_resultado_id", ["" => "Selecione um tipo de resultado"] + $loadFields['tiporesultado']->toArray(), null,
                                     array('class'=> 'form-control', 'id' => 'tipo_resultado_id', 'disabled' => 'disabled')) !!}
                                @else
                                    {!! Form::select("tipo_resultado_id", ["" => "Selecione um tipo de resultado"] + $loadFields['tiporesultado']->toArray(), null,
                                    array('class'=> 'form-control', 'id' => 'tipo_resultado_id')) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" id="chameleon">

                        <!-- Formulário para nota -->
                        <div id="nota">
                            <div class="topo-conteudo-full">
                                <h4>Notas</h4>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="menor_nota">Menor Nota</label>
                                            {!! Form::text('menor_nota', Session::getOldInput('menor_nota'), array('class' => 'form-control input-sm', 'placeholder' => 'Menor Nota')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="maior_nota">Maior Nota</label>
                                            {!! Form::text('maior_nota', Session::getOldInput('maior_nota'), array('class' => 'form-control input-sm', 'placeholder' => 'Maior Nota')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="variacao">Variação</label>
                                            {!! Form::text('variacao', Session::getOldInput('variacao'), array('class' => 'form-control input-sm', 'placeholder' => 'Variação')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="minimo_aprovacao">Mínimo para aprovação</label>
                                            {!! Form::text('minimo_aprovacao', Session::getOldInput('minimo_aprovacao'), array('class' => 'form-control input-sm', 'placeholder' => 'Mínimo para aprovação')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim do Formulário para nota -->

                        <!-- Formulário para forma de avaliação -->
                        <div id="nivelAlfabetizacao">
                            <div class="topo-conteudo-full">
                                <h4>Níveis de Alfabetização</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="hidden" name="niveis_alfabeizacao" id="niveis_alfabeizacao">
                                        <div class="form-group col-md-2">
                                            <div class="fg-line">
                                                <div class="fg-line">
                                                    <label for="codigo_nivel_alfabetizacao">Nível</label>
                                                    {!! Form::text(null, null, array('class' => 'form-control input-sm', 'placeholder' => 'Nível', 'id' => 'codigo_nivel_alfabetizacao')) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="fg-line">
                                                <div class="fg-line">
                                                    <label for="nome_nivel_alfabetizacao">Descrição</label>
                                                    {!! Form::text(null, null, array('class' => 'form-control input-sm', 'placeholder' => 'Descrição', 'id' => 'nome_nivel_alfabetizacao')) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label>M. para Aprovação:</label>
                                            <div class="form-group">
                                                <label for="min_aprovacao_nivel_alfabetizacao" class="checkbox checkbox-inline m-r-20">
                                                    {!! Form::checkbox(null, 1, null, ['id' => 'min_aprovacao_nivel_alfabetizacao']) !!}
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <a class="btn btn-primary btn-sm m-t-10" id="btn_nivel_alfabetizacao" onclick="objNivelTable.newNivel()">Adicionar</a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="nivel-alfabetizacao-grid" class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 15%;">Nível</th>
                                                        <th>Descrição</th>
                                                        <th style="width: 15%;">M. para Aprovação</th>
                                                        <th style="width: 5%;">Açao</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim do Formulário para forma de avaliação -->

                        <!-- Formulário para o parecer -->
                        <div id="parecer">
                            <div class="topo-conteudo-full">
                                <h4>Parecer</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <div class=" fg-line">
                                            <label for="parecer">Parecer Armazenado</label>
                                            <div class="select">
                                                {!! Form::select("parecer", ["" => "Selecione um parecer"] + [0 => 'Não', 1 => 'Sim'], null,
                                                 array('class'=> 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Formulário para o parecer -->

                    </div>
                </div>

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('formaAvaliacao.index') }}">Voltar</a>
            </div>
        </div>
    </div>
</div>


@section('javascript')
    @parent
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>

    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/formaAvaliacao.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/alphaSpace.js')  }}"></script>

    {{-- Controler dos formulários de tipos de resultados --}}
    <script type="text/javascript" src="{{ asset('/dist/formaAvaliacao/gerenciamento_niveis_alfabetizacao.js')  }}"></script>
    <script type="text/javascript">
        // Evento inicial
        $(document).ready(function () {
            // Escondendo todos os formulários
            hideAll();

            // Tratamento para update
            @if(isset($model))
                // Caso for o formulário de notas
                @if($model->tipo_resultado_id == 1)
                    $('#nota').show();
                @endif

                // Caso for o formulário de parecer
                @if($model->tipo_resultado_id == 2)
                    $('#nivelAlfabetizacao').show();
                @endif

                // Caso for o formulário de parecer
                @if($model->tipo_resultado_id == 3)
                    $('#parecer').show();
                @endif

                // Instanciando um objeto da grid para criação
                objNivelTable = new TableNivelEdit({{$model->id}});
            @else
                // Instanciando um objeto da grid para criação
                objNivelTable = new TableNivelCreate();
            @endif
        });

        // Mudança no tipo de resultado
        $(document).on('change', '#tipo_resultado_id', function () {
            // Recuperando o valor selecionado
            var value = parseInt($(this).val());

            // Escolha do form para exibir
            switch (value) {
                // Caso for o forumulário de notas
                case 1:
                    hideAll();
                    $('#nota').show();
                break;
                // Caso for o forumulário de niveis de alfabetização
                case 2:
                    hideAll();
                    $('#nivelAlfabetizacao').show();
                break;
                // Caso for o forumulário de parecer
                case 3:
                    hideAll();
                    $('#parecer').show();
                break;
                // Caso não for nenhum dos formulários :)
                default:
                    hideAll();
            }
        });


        // evento para interromper a submissão
        $('#formFormaAvaliacao').submit(function (event) {
            @if(!isset($model))
                // Variável quer armazenará os conteudos
                var niveis = [];

                // Percorrendo todos os conteudos
                $.each(objNivelTable.getTable().rows().data(),function (index, valor) {
                    niveis[index] = new Object();
                    niveis[index]['codigo'] = valor[0];
                    niveis[index]['nome']   = valor[1];
                    niveis[index]['minimo'] = valor[2] == "Sim" ? 1 : 0;
                });

                // Adicionando na requisição
                $("#niveis_alfabeizacao").val(JSON.stringify(niveis));
            @endif
        });

        // Função para esconder todos os formulários
        function hideAll() {
            $('#nota').hide();
            $('#nivelAlfabetizacao').hide();
            $('#parecer').hide();
        }

        // Evento no click do checkbox de mímino para aprovação
        $(document).on('click', '#min_aprovacao_nivel_alfabetizacao', function () {
            if($(this).is(':checked')) {
                swal("Marcando esse nível como mímino para aprovação, estará automaticamente desativando o mínimo atual.", "Click no botão abaixo!", "warning");
            }
        });
    </script>
@endsection