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
            {data: 'matricula', name: 'edu_historico.matricula'},
            {data: 'data_matricula', name: 'edu_historico.data_matricula'},
            {data: 'turma', name: 'edu_turmas.nome'},
            {data: 'escola', name: 'edu_escola.nome'},
            {data: 'curso', name: 'edu_cursos.nome'},
            {data: 'curriculo', name: 'edu_curriculos.nome'},
            {data: 'calendario_ano', name: 'edu_calendarios.ano'},
            {data: 'serie', name: 'edu_series.nome'},
            {data: 'turno', name: 'edu_turnos.nome'},
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
    var vagas = $('#vagas-historico').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!turma) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'aluno_id' : idAluno,
        'turma_id' : turma,
        'vagas'    : vagas
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('aluno.storeAlunoTurma'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['success']) {
            swal("Aluno(s) matriculado(s) com sucesso!", "Click no botão abaixo!", "success");
            tableAlunoTurmas.ajax.reload();
            table.ajax.reload();
        } else {
            swal(json['mensagem'], "Click no botão abaixo!", "error");
        }

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

    if(turma) {

        // Requisição Ajax
        jQuery.ajax({
            type: 'POST',
            url: laroute.route('aluno.getDadosTurma'),
            data: dados,
            datatype: 'json'
        }).done(function (retorno) {

            $('#serie-historico').val(retorno['dados']['serie']);
            $('#turno-historico').val(retorno['dados']['turno']);
            $('#vagas-historico').val(retorno['dados']['vagas']);
            $('#matriculados-historico').val(retorno['qtdAlunos']);
            $('#vagas-restantes-historico').val(retorno['vRestantes']);

        });

    } else {
        $('#serie-historico').val("");
        $('#turno-historico').val("");
        $('#vagas-historico').val("");
        $('#matriculados-historico').val("");
        $('#vagas-restantes-historico').val("");
    }


});

//Limpar os campos do formulário
function limparCamposAlunosTurmas()
{
    turmas("");
    $('#data').val("");

}



