// Carregando a table
var tableHistoricoAluno;
function loadTableHistoricoAluno (idAluno) {
    // Carregaando a grid
    tableHistoricoAluno = $('#historico-aluno-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('aluno.gridAlunoTurma', {'id' :idAluno }),
        columns: [
            {data: 'matricula', name: 'edu_historico.matricula'},
            {data: 'data_matricula', name: 'edu_historico.data_matricula'},
            {data: 'turma', name: 'edu_turmas.nome'},
            {data: 'escola', name: 'edu_escola.nome'},
            {data: 'curso', name: 'edu_cursos.nome'},
            {data: 'curriculo', name: 'edu_curriculos.nome'},
            {data: 'calendario_ano', name: 'edu_calendarios.ano'},
            {data: 'serie', name: 'edu_series.nome'},
            {data: 'turno', name: 'edu_turnos.nome'},
            {data: 'situacao', name: 'edu_situacao_matricula.nome'}
        ]
    });

    return tableHistoricoAluno;
}


// Função de execução
function runModalHistoricoAluno(idAluno)
{
    //Carregando as grids de histórico dos alunos
    if(tableHistoricoAluno) {
        loadTableHistoricoAluno(idAluno).ajax.url(laroute.route('aluno.gridAlunoTurma', {'id' :idAluno })).load();
    } else {
        loadTableHistoricoAluno(idAluno);
    }

    // Exibindo o modal
    $('#modal-historico-aluno').modal({'show' : true});
}



