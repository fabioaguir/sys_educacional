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
            {data: 'matricula', name: 'alunos_turmas.matricula'},
            {data: 'data_matricula', name: 'alunos_turmas.data_matricula'},
            {data: 'turma', name: 'turmas.nome'},
            {data: 'escola', name: 'escola.nome'},
            {data: 'curso', name: 'cursos.nome'},
            {data: 'curriculo', name: 'curriculos.nome'},
            {data: 'calendario_ano', name: 'calendarios.ano'},
            {data: 'serie', name: 'series.nome'},
            {data: 'turno', name: 'turnos.nome'},
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

        console.log(retorno);

        var html = '<tr>';
        html += '<td>'+retorno['dados']['escola']+'</td>';
        html += '<td>'+retorno['dados']['curso']+'</td>';
        html += '<td>'+retorno['dados']['curriculo']+'</td>';
        html += '<td>'+retorno['dados']['calendario_nome'] +' '+ retorno['dados']['calendario_ano']+'</td>';
        html += '<td>'+retorno['dados']['serie']+'</td>';
        html += '<td>'+retorno['dados']['turno']+'</td>';
        html += '<td>'+retorno['dados']['vagas']+'</td>';
        html += '<td>'+retorno['qtdAlunos']+'</td>';
        html += '<td>'+retorno['vRestantes']+'</td>';
        html += '</tr>';

        $('#dados-turma tbody tr').remove();
        $('#dados-turma tbody').append(html);

    });

});

//Limpar os campos do formulário
function limparCamposAlunosTurmas()
{
    turmas("");
    $('#data').val("");

}



