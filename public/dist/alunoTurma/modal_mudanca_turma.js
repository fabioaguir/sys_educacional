
// Função de execução
function runModalMudarTurma(idMatricula, idSerie, idEscola, idTurma)
{

    turmaParaMudancaTurma(idTurma, idSerie, idEscola);

    // Exibindo o modal
    $('#modal-mudanca-turma').modal({'show' : true});
}

// Id do alocacao
var idAlunoTurma;


//Evento do click no botão adicionar período
$(document).on('click', '#mudarTurma', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma = $('#turma_mudanca').val();
    var vagas = $('#vagas-historico').val();
    var matriculaAtual = idMatricula;
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!turma) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'matricula_atual' : matriculaAtual,
        'turma_id' : turma,
        'vagas'    : vagas
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('aluno.storeMudarTurma'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['success']) {
            swal("Aluno(s) matriculado(s) com sucesso!", "Click no botão abaixo!", "success");
            table.ajax.reload();
        } else {
            swal(json['mensagem'], "Click no botão abaixo!", "error");
        }

        //Limpar os campos do formulário
        limparCamposAlunosTurmas();
        $('#modal-mudanca-turma').modal('toggle');
    });
});

//Evento para pegar o dia da semana da data de feriado informado
$(document).on('change', '#turma_mudanca', function () {

    // Recuperando o valor da data inicial
    var turma = $(this).val();

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

            $('#turno-mudanca-turma').val(retorno['dados']['turno']);
            $('#vagas-mudanca-turma').val(retorno['dados']['vagas']);
            $('#matriculados-mudanca-turma').val(retorno['qtdAlunos']);
            $('#vagas-restantes-mudanca-turma').val(retorno['vRestantes']);

        });

    } else {
        $('#turno-mudanca-turma').val("");
        $('#vagas-mudanca-turma').val("");
        $('#matriculados-mudanca-turma').val("");
        $('#vagas-restantes-mudanca-turma').val("");
    }


});

//Limpar os campos do formulário
function limparCamposAlunosTurmas()
{
    turmaParaMudancaTurma("", "", "");

}



