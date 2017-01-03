// Carregando a table
var tableAlunoTurmas;
function loadTableAlunoTurmas (idAluno) {
    // Carregaando a grid
    tableAlunoTurmas = $('#aluno-turmas-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('aluno.gridAlunoTurma', {'id' :idAluno }),
        columns: [
            {data: 'turma', name: 'turmas.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAlunoTurmas;
}


// Função de execução
function runModalAdicionarAlunosTurmas(idAluno)
{
    //Carregando as grids de alocações
    if(tableAlunoTurmas) {
        loadTableAlunoTurmas(idAluno).ajax.url(laroute.route('aluno.gridAlunoTurma', {'id' :idAluno })).load();
    } else {
        loadTableAlunoTurmas(idAluno);
    }

    // Exibindo o modal
    $('#modal-adicionar-aluno-turma').modal({'show' : true});
}

// Id do alocacao
var idAlunoTurma


//Evento do click no botão adicionar período
$(document).on('click', '#addAlunoTurma', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma = $('#turma').val();
    var data = $('#data').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!turma || !data) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'alunos_id' : idAluno,
        'turmas_id' : turma,
        'data_matricula' : data
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('aluno.storeAlunoTurma'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Aluno(s) matriculado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAlunoTurmas.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposAlunosTurmas();
    });
});

//Evento para pegar o dia da semana da data de feriado informado
$(document).on('change', '#turma', function () {

    // Recuperando o valor da data inicial
    var turma = $('#turma').val();

    //Setando o o json para envio
    var dados = {
        'turma' : turma
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('aluno.getDadosTurma'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {

        //$('#diaSemana').val(retorno);

    });

});

//Limpar os campos do formulário
function limparCamposAlunosTurmas()
{
    turmas("");
    $('#data').val("");

}



