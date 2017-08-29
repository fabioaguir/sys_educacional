// Variáveis globais
var idTurma, idAluno, idPeriodo;
var nomeAluno, nomePeriodo;


//Evento do click para matricular
$(document).on('click', '#consultarNota', function (event) {


    //Recuperando os valores dos campos do fomulário
    var turma  = idTurma;
    idAluno  = $('#aluno').val();
    idPeriodo = $('#periodo').val();

    nomeAluno       = $('select[id=aluno] option:selected').text();
    nomePeriodo     = $('select[id=periodo] option:selected').text();

    $('#nomeAluno').text(nomeAluno);
    $('#nomePeriodo').text(nomePeriodo);

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!idAluno && !idPeriodo) {
        swal("Oops...", "Você deve selecionar um aluno um período e uma disciplina!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'turma' : turma,
        'aluno' : idAluno,
        'periodo' : idPeriodo
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.notaparecer.consultar'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['return']) {

            $('#parecer').val(json['return']['parecer']);
            $('#id-nota').val(json['return']['id']);

        } else {
            $('#parecer').val('');
            $('#id-nota').val('');
        }

    });

});


//Evento do click para matricular
$(document).on('click', '#inserirNota', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma  = idTurma;

    // notas
    var parecer = $("#parecer").val();
    var idParecer = $("#id-nota").val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!aluno && !periodo && !parecer) {
        swal("Oops...", "Você deve selecionar um aluno um período e uma disciplina!", "error");
        return false;
    }

    // Setando o o json para envio
    var dados = {
        'turma_id' : turma,
        'aluno_id' : idAluno,
        'periodo_id' : idPeriodo,
        'parecer' : parecer,
        'id'      : idParecer
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.notaparecer.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['return']) {
            swal("Parecer inserido com sucesso!", "Click no botão abaixo!", "success");

            $('#parecer').val(json['return']['parecer']);
            $('#id-nota').val(json['return']['id']);

        } else {
            swal('Erro ao inserir o parecer!', "Click no botão abaixo!", "error");
        }

    });

});

