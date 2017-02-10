<div class="block-header">
    <h2>Redefinição de Senha</h2>
</div>
<div class="card">
    <div class="card-body card-padding">

        {{--<input type="hidden" id="idUsuario" value="{{ isset(Auth::user()->id) ? Auth::user()->id : null }}">--}}

        {!! Form::text("idUsuario", Auth::user()->id ? Auth::user()->id : null, array('class' => 'hidden', 'id' => 'idUsuario')) !!}

        <div class="row">
            <div class="form-group col-sm-4">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="senha_atual">Senha Atual</label>
                        {!! Form::text("senha_atual", Session::getOldInput("senha_atual"), array('id' => 'password', 'class' => 'form-control input-sm', 'placeholder' => 'Senha atual')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-2">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="password">Nova Senha: </label>
                        {!! Form::text("password", Session::getOldInput("password"), array('class' => 'form-control input-sm', 'placeholder' => 'Nova senha')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-2">
                <div class="fg-line">
                    <div class="fg-line">
                        <label for="password_confirmation">Confirmar Nova Senha: </label>
                        {!! Form::text("password_confirmation", Session::getOldInput("password_confirmation"), array('class' => 'form-control input-sm', 'placeholder' => 'Confirmar nova senha')) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <button class="btn btn-primary btn-sm m-t-10 submit">Salvar</button>
        {{--<a class="btn btn-primary btn-sm m-t-10" href="{{ route('aluno.index') }}">Voltar</a>--}}
    </div>
</div>

@section('javascript')
    {{--Mensagens personalizadas--}}
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    {{--Regras adicionais--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/adicional/confirmPassword.js')  }}"></script>
    {{--Regras de validação--}}
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/user_alterarSenha.js')  }}"></script>
@endsection