// Evento para chamar o modal de adicionar matéria ao curso
$(document).on("click", "#addProcedimento", function () {
    loadFields();
});

// carregando todos os campos preenchidos
function loadFields()
{
    // Definindo os models
    var dados =  {
        'models' : [
            'FormaAvaliacao',
            'Periodo'
        ]
    };

    // Fazendo a requisição ajax
    jQuery.ajax({
        type: 'GET',
        data: dados,
        url: laroute.route('procedimentoAvaliacao.procedimento.loadFields'),
        datatype: 'json'
    }).done(function (retorno) {
        // Verificando o retorno da requisição
        if(retorno) {
            builderHtmlFields(retorno);
        } else {
            // Retorno caso não tenha currículo em uma turma ou algum erro
            swal(retorno.msg, "Click no botão abaixo!", "error");
            $('#modal-procedimentos-create').modal('toggle');
        }
    });
};

// Função a montar o html
function builderHtmlFields (dados) {
    //Limpando os campos
    $('#periodo_avaliacao_id option').attr('selected', false);
    $('#forma_avaliacao_id option').attr('selected', false);
    $('#aparecer_boletim').attr('checked', false);

    // Variáveis que armazenaram o html
    var htmlPeriodoAvaliacao = "<option value=''>Selecione um Período de Avaliação</option>";
    var htmlFormaAvaliacao   = "<option value=''>Selecione uma Forma da Avaliação</option>";
    
    // Percorrendo o array de períodos
    for (var i = 0; i < dados['periodo'].length; i++) {
        htmlPeriodoAvaliacao += "<option value='" + dados['periodo'][i].id + "'>"  + dados['periodo'][i].nome + "</option>";
    }

    // Percorrendo o array de forma avaliação
    for (var i = 0; i < dados['formaavaliacao'].length; i++) {
        htmlFormaAvaliacao += "<option value='" + dados['formaavaliacao'][i].id + "'>"  + dados['formaavaliacao'][i].nome + "</option>";
    }

    // carregando o html
    $("#periodo_avaliacao_id option").remove();
    $("#periodo_avaliacao_id").append(htmlPeriodoAvaliacao);
    $("#forma_avaliacao_id option").remove();
    $("#forma_avaliacao_id").append(htmlFormaAvaliacao);

    // Abrindo o modal de criar procedimento
    $("#modal-procedimentos-create").modal({show : true});
}


// Evento para salvar tabela de disciplinas extras curriculares dos alunos
$('#btnSaveProcedimento').click(function() {
    // Recuperando os valores do formulário
    var periodo_avaliacao_id = $("#periodo_avaliacao_id option:selected").val();
    var forma_avaliacao_id = $("#forma_avaliacao_id option:selected").val();
    var aparecer_boletim = $("#aparecer_boletim").is(':checked') ? 1 : 0;

    // Validando os dados de entrada
    if(!periodo_avaliacao_id || !forma_avaliacao_id) {
        swal('Você deve informar o período e a forma de avaliação!', "Click no botão abaixo!", "error");
        return false;
    }

    // Dados de envio
    var dados = {
        'periodo_avaliacao_id' : periodo_avaliacao_id,
        'forma_avaliacao_id' : forma_avaliacao_id,
        'aparecer_boletim' : aparecer_boletim,
        'procedimento_avaliacao_id' : idProcedimentoAvaliacao
    };

    jQuery.ajax({
        type: 'POST',
        url: laroute.route('procedimentoAvaliacao.procedimento.store'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        if(retorno.success) {
            // Recarregando as grids
            tableProcedimento.ajax.reload();
            table.ajax.reload();

            // fechando a modal
            $('#modal-procedimentos-create').modal('toggle');
            swal(retorno.msg, "Click no botão abaixo!", "success");
        } else {
            swal(retorno.msg, "Click no botão abaixo!", "error");
        }
    });
});


// Evento para o click no botão de remover disciplina
$(document).on('click', '#btnDestroyProcedimento', function () {
    var id = tableProcedimento.row($(this).parents('tr')).data().id;

    // Requisição ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('procedimentoAvaliacao.procedimento.destroy', {'id' : id}),
        datatype: 'json'
    }).done(function (retorno) {
        if(retorno.success) {
            // Recarregando as grids
            tableProcedimento.ajax.reload();
            table.ajax.reload();
            
            swal(retorno.msg, "Click no botão abaixo!", "success");
        } else {
            swal(retorno.msg, "Click no botão abaixo!", "error");
        }
    });
});