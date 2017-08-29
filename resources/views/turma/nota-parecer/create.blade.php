@extends('menu')

@section('content')
    <div class="container">
        <section id="content">
            {{-- Mensagem de alerta quando os dados não atendem as regras de validação que foramd efinidas no servidor --}}
            <div class="ibox-content">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <em> {!! session('message') !!}</em>
                    </div>
                @endif

                @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="block-header">
                <h2>Atribuição de notas por parecer</h2>
            </div>
            <div class="card">
                <div class="card-body card-padding">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group col-md-5">
                                <div class=" fg-line">
                                    <label for="aluno">Aluno</label>
                                    <select class="form-control" id="aluno">
                                        <option value="" >Selecione o aluno</option>
                                        @foreach($alunos as $aluno)
                                            <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="periodo">Período</label>
                                    <select class="form-control" id="periodo">
                                        <option value="" >Selecione o período</option>
                                        @foreach($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-1" style="margin-top: 20px">
                                <div class=" fg-line">
                                    <button id="consultarNota"  class="btn btn-primary btn-sm m-t-10">Consultar</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <div class=" fg-line">
                                    <label for="relato">Parecer</label>
                                    <div class="textarea">
                                        {!! Form::textarea('parecer', Session::getOldInput('parecer'),
                                            array('id' => 'parecer', 'class' => 'form-control', 'rows' => '5')) !!}
                                    </div>
                                    <input type="hidden" class="form-control" id="id-nota">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-1" style="margin-top: 20px">
                                <div class=" fg-line">
                                    <button id="inserirNota"  class="btn btn-primary btn-sm m-t-10">Salvar</button>
                                </div>
                            </div>
                            <div class="form-group col-md-1" style="margin-top: 20px">
                                <div class=" fg-line">
                                    <a href="{{ route('turma.index') }}" class="btn btn-default btn-sm m-t-10">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/turma/notaparecer/inserir_nota.js')  }}"></script>
    <script>
        idTurma = "{{ $idTurma  }}";
    </script>
@endsection