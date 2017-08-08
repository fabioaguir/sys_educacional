// Carregando a table
var tableAluno;
function loadTableAluno (idTurma) {
    // Carregaando a grid
    tableAluno = $('#alunos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turma.aluno.grid', {'idTurma' : idTurma }),
        columns: [
            {data: 'matricula', name: 'edu_historico.matricula'},
            {data: 'nome', name: 'gen_cgm.nome'},
            {data: 'data_matricula', name: 'edu_historico.data_matricula'}
        ]
    });

    return tableAluno;
}

// Função de execução
function runModalAluno(idTurma)
{
    //Carregando as grids de alunos
    if(tableAluno) {
        loadTableAluno(idTurma).ajax.url(laroute.route('turma.aluno.grid', {'idTurma' :idTurma })).load();
    } else {
        loadTableAluno(idTurma);
    }
    
    // Exibindo o modal
    $('#modal-alunos').modal({'show' : true});
}