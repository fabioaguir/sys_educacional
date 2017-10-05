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
                <h2>Atribuição de notas - {{ $turma->nome }}</h2>
            </div>
            <div class="card">
                <div class="card-body card-padding">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group col-md-3">
                                <div class=" fg-line">
                                    <label for="disciplina">Disciplina</label>
                                    <select class="form-control" id="disciplina">
                                        <option value="" >Selecione a disciplina</option>
                                        @foreach($disciplinas as $disciplina)
                                            <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
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

                    {!! Form::open(['route'=>'turma.notabydisciplina.store', 'id' => 'form-nota', 'method' => "POST" ]) !!}
                        <div class="row notas">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="table-nota" class="display table table-border compact">
                                        <thead>
                                        <tr>
                                            <th colspan="8">
                                                <b>DISCIPLINA: </b><span id="nomeDisciplina"></span> -- <b>PERÍODO:</b> <span
                                                        id="nomePeriodo"></span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Aluno</th>
                                            <th>1º Ativ.</th>
                                            <th>2º Ativ.</th>
                                            <th>3º Ativ.</th>
                                            <th>Verif. de Aprend.</th>
                                            <th>Média</th>
                                            <th>Recup. Paralela</th>
                                            <th>Nota P/ Recuper.</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-1" style="margin-top: 20px">
                                    <div class=" fg-line">
                                        <button type="submit"  class="btn btn-primary btn-sm m-t-10">Salvar</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-1" style="margin-top: 20px">
                                    <div class=" fg-line">
                                        <a href="{{ route('turma.index') }}" class="btn btn-default btn-sm m-t-10">Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </section>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{{ asset('/dist/turma/notabydisciplina/inserir_nota.js')  }}"></script>
    <script>
        idTurma = "{{ $idTurma  }}";
    </script>
@endsection