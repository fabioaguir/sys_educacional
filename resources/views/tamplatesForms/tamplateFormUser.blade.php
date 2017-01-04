<div class="block-header">
    <h2>Cadastro de Usuário</h2>
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
                        <li><a href="#roles" aria-controls="roles" role="tab" data-toggle="tab">Perfís</a></li>
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
                                            {!! Form::text('name', Session::getOldInput('name'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome do Usuário')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="email">E-mail *</label>
                                            {!! Form::text('email', Session::getOldInput('email'), array('class' => 'form-control input-sm', 'placeholder' => 'E-mail do Usuário')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="fg-line">
                                        <div class="fg-line">
                                            <label for="password">Senha *</label>
                                            {!! Form::password('password', array('class' => 'form-control input-sm', 'placeholder' => 'Senha do Usuário')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Dados Gerais -->

                        <!-- Perfís-->
                        <div role="tabpanel" class="tab-pane" id="roles">
                            <div>
                                <ul style="list-style: none;">
                                    @if(isset($loadFields['role']))
                                        @foreach($loadFields['role'] as $id => $role)
                                            @if(isset($model) && \in_array($role, $model->roles->pluck('name')->all()))
                                                <li style="display: inline; margin-right: 10px;"><input  type="checkbox" name="role[]" checked value="{{ $id  }}"> {{ $role }} </li>
                                            @else
                                                <li style="display: inline; margin-right: 10px;"><input  type="checkbox" name="role[]" value="{{ $id  }}"> {{ $role }} </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- Fim Perfís -->
                    </div>
                    <!-- Fim Conteúdo -->
                </div>
                <!-- Fim Painel -->

                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('user.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>

    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/user.js')  }}"></script>
@endsection