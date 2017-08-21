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
                <h2>Atribuição de notas</h2>
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

                            <div class="form-group col-md-1" style="margin-top: 20px">
                                <div class=" fg-line">
                                    <button id="consultarNota"  class="btn btn-primary btn-sm m-t-10">Consultar</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-border">
                                <thead>
                                    <tr>
                                        <th colspan="7">
                                            <b>ALUNO(A): </b><span id="nomeAluno"></span> -- <b>PERÍODO:</b> <span id="nomePeriodo"></span>
                                            -- <b>DICISPLNA:</b> <span id="nomeDisciplina"></span>
                                        </th>
                                    </tr>
                                <tr>
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
                                    <tr>
                                        <td>
                                            <input class="form-control nota" id="1_ativ">
                                        </td>
                                        <td>
                                            <input class="form-control nota" id="2_ativ">
                                        </td>
                                        <td>
                                            <input class="form-control nota" id="3_ativ">
                                        </td>
                                        <td>
                                            <input class="form-control nota" id="verif_aprend">
                                        </td>
                                        <td>
                                            <input disabled readonly class="form-control nota" id="media">
                                        </td>
                                        <td>
                                            <input class="form-control nota" id="recup_paralela">
                                        </td>
                                        <td>
                                            <input class="form-control nota" id="nota_recuper">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-1" style="margin-top: 20px">
                                <div class=" fg-line">
                                    <button id="inserirNota"  class="btn btn-primary btn-sm m-t-10">Salvar</button>
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
    <script type="text/javascript" src="{{ asset('/dist/turma/notacomum/inserir_nota.js')  }}"></script>
    <script>
        idTurma = "{{ $idTurma  }}";
    </script>
@endsection