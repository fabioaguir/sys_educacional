<!-- Modal principal de disciplinas -->
<div id="modal-report-fixa-do-aluno" class="modal fade modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalProfile"
     aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" id="closeModalHistorico" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="material-icons">date_range</i> Filtro - Por calendário e turma</h4>
            </div>
            <div class="modal-body" style="alignment-baseline: central">
                <div class="row">
                   <div class="col-md-12">
                       <div class="form-group">
                           {!! Form::label('calendarios', 'Calendário') !!}
                           {!! Form::select('calendarios', [], null, array('class' => 'form-control', 'id' => 'calendario_id')) !!}
                       </div>

                       <div class="form-group">
                           {!! Form::label('turmas', 'Turma') !!}
                           {!! Form::select('turmas', [], null, array('class' => 'form-control', 'id' => 'turma_id')) !!}
                       </div>

                       <div class="form-group">
                           {!! Form::label('alunos', 'Alunos') !!}
                           {!! Form::select('alunos', [], null, array('class' => 'form-control', 'id' => 'aluno_id')) !!}
                       </div>

                       <div class="form-group">
                           <button class="btn-sm btn-primary" type="submit" id="btnFixaDoAluno">Relatório</button>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM Modal de cadastro das Disciplinas-->