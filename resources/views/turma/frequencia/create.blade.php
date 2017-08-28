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
                <h2>Frequência</h2>
            </div>
            <div class="card">
                <div class="card-body card-padding">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group col-md-3">
                                <div class=" fg-line">
                                    <label for="professor">Professores *</label>
                                    <select class="form-control" id="professor">
                                        <option value="" >Selecione o professor</option>
                                        @foreach($professores as $professore)
                                            <option value="{{ $professore->id }}">{{ $professore->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class=" fg-line">
                                    <label for="disciplina">Disciplina *</label>
                                    <select class="form-control" id="disciplina">
                                        {{--<option value="" >Selecione a disciplina</option>--}}
                                        {{--@foreach($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->nome }}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class=" fg-line">
                                    <label for="data_inicio">Data de início *</label>
                                    <input type="text" class="form-control date" id="data_inicio">
                                </div>
                            </div>

                            <div class="form-group col-md-1" style="margin-top: 20px">
                                <div class=" fg-line">
                                    <button id="consultarFrequencia"  class="btn btn-primary btn-sm m-t-10">Consultar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br />
                    <div class="row">
                        {!! Form::open(['route'=>'turma.frequencia.store', 'id' => 'form-frequencia', 'method' => "POST" ]) !!}
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="table-frequencia" class="display table table-border compact">

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-1" style="margin-top: 20px">
                                    <div class=" fg-line">
                                        <button id="inserirNota"  type="submit"  class="btn btn-primary btn-sm m-t-10">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/turma/frequencia/loadFields.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/turma/frequencia/inserir_frequencia.js')  }}"></script>
    <script>
        idTurma = "{{ $idTurma  }}";
    </script>
@endsection