<div class="block-header">
    <h2>Cadastro de Perfil</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">

                <!-- Painel -->
                <div role="tabpanel">
                    <!-- Guias -->
                    <ul id="tabs" class="tab-nav" role="tablist" data-tab-color="cyan">
                        <li class="active"><a href="#dadosGerais" aria-controls="dadosGerais" role="tab" data-toggle="tab">Dados Gerais</a></li>
                        <li><a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab">Permissões</a></li>
                    </ul>
                    <!-- Fim Guias -->

                    <!-- Conteúdo -->
                    <div class="tab-content">
                        <!-- Dados Gerais -->
                        <div role="tabpanel" class="tab-pane active" id="dadosGerais">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="name">Nome *</label>
                                            {!! Form::text('name', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do Perfil')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="description">Descrição *</label>
                                            {!! Form::text('description', Session::getOldInput('description'), array('class' => 'form-control input-sm', 'placeholder' => 'Descrição do Perfil')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Dados Gerais -->

                        <!-- Perfís-->
                        <div role="tabpanel" class="tab-pane" id="permissions">
                            <div class="row" style="margin-left: 2.5%;">
                                <div class="col-md-2">
                                    <a style="cursor:pointer;" id="markAll">Marcar Todos</a>
                                </div>

                                <div class="col-md-2">
                                    <a style="cursor:pointer;" id="unmarkAll">Desmarcar Todos</a>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 2%;">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if(isset($loadFields['permission']))
                                            @if(isset($loadFields['permission']) && count($loadFields['permission']) > 0)
                                                <?php
                                                $permissions = $loadFields['permission'];
                                                $models = $loadFields['model'];
                                                $count = 0;
                                                ?>

                                                @foreach($models as $model)
                                                    @if($count == 3)
                                                        <div class="row">
                                                            @endif

                                                            <div class="col-md-3">
                                                                <h5 style="font-weight: bold; margin-left: 16%;">{{ $model }}</h5>

                                                                <ul class="list-permission" style="list-style: none;">
                                                                    @foreach($permissions as $permission)
                                                                        @if($model == $permission->model)
                                                                            @if(isset($role) && \in_array($permission->slug, $role->permissions->pluck('slug')->all()))
                                                                                <li><input class="check-permission" type="checkbox" name="permission[]" checked value="{{ $permission->id }}"> {{ $permission->name }} </li>
                                                                            @else
                                                                                <li><input class="check-permission" type="checkbox" name="permission[]" value="{{ $permission->id }}"> {{ $permission->name }} </li>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                            @if($count == 3)
                                                        </div>
                                                    @endif

                                                    <?php
                                                    if($count == 3) {
                                                        $count = 0;
                                                    } else {
                                                        $count++;
                                                    }
                                                    ?>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim das Permissões -->
                    </div>
                    <!-- Fim Conteúdo -->
                </div>
                <!-- Fim Painel -->

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('role.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>

    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/role.js')  }}"></script>
    <script type="text/javascript">
        $(document).on('click', '#markAll', function () {
            $('.check-permission').each(function(){
                $(this).prop("checked", true);
            });
        });

        $(document).on('click', '#unmarkAll', function () {
            $('.check-permission').each(function() {
                $(this).prop("checked", false);
            });
        });
    </script>
@endsection