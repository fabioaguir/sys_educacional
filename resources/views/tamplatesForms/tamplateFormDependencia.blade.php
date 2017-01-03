<div class="block-header">
    <h2>Cadastro de dependência</h2>
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-sm-5 m-b-15">
                        {{--<div class="fg-line">--}}
                        <label for="escola_id">Escola *</label>
                        <div class="select">
                            {!! Form::select("escola_id", ["" => "Selecione"] + $loadFields['escola']->toArray(), null, array('class'=> 'form-control')) !!}
                        </div>
                        {{-- </div>--}}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="nome">Nome *</label>
                                {!! Form::text('nome', Session::getOldInput('nome'), array('class' => 'form-control input-sm', 'placeholder' => 'Nome da Dependência')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="fg-line">
                            <div class="fg-line">
                                <label for="capacidade">Capacidade *</label>
                                {!! Form::text('capacidade', Session::getOldInput('capacidade'), array('class' => 'form-control input-sm', 'placeholder' => 'Capacidade da Dependência')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm m-t-10">Salvar</button>
                <a class="btn btn-primary btn-sm m-t-10" href="{{ route('dependencia.index') }}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/js/messages_pt_BR.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/lib/jquery-validation/src/additional/integer.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/adicional/alphaSpace.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/validacao/dependencia.js')  }}"></script>
@endsection