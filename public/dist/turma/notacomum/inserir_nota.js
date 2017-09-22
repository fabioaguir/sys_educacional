// Variáveis globais
var idTurma, idAluno, idPeriodo, idsDisciplina;
var nomeAluno, nomePeriodo;


//Evento do click para matricular
$(document).on('click', '#consultarNota', function (event) {


    // Pegando os ids das disciplinas
    idsDisciplina = new Array();
    $('.disciplina').each(function() {
        idsDisciplina.push($(this).val());
    });

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
        'periodo' : idPeriodo,
        'disciplinas' : idsDisciplina
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.nota.consultar'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['msg'] == 'success') {

            $(".notas").show();

            if (json['return'].length > 0) {

                // Varrendo as notas existentes do aluno por disciplina
                for ( var i = 0; i < json['return'].length; i++ ) {
                    $(".1_ativ_"+json['return'][i]['disciplina_id']).val(json['return'][i]['nota_ativ1']);
                    $(".2_ativ_"+json['return'][i]['disciplina_id']).val(json['return'][i]['nota_ativ2']);
                    $(".3_ativ_"+json['return'][i]['disciplina_id']).val(json['return'][i]['nota_ativ3']);
                    $(".verif_aprend_"+json['return'][i]['disciplina_id']).val(json['return'][i]['nota_verif_aprend']);
                    $(".media_"+json['return'][i]['disciplina_id']).val(json['return'][i]['media']);
                    $(".recup_paralela_"+json['return'][i]['disciplina_id']).val(json['return'][i]['recup_paralela']);
                    $(".nota_recuper_"+json['return'][i]['disciplina_id']).val(json['return'][i]['nota_para_recup']);
                    $(".idNota_"+json['return'][i]['disciplina_id']).val(json['return'][i]['id']);
                }

            } else {
                $('.nota').val('');
                $('.idNota').val('');
            }

        } else {
            swal("Oops...", json['msg'], "error");
            $(".notas").hide();
        }

    });

});


//Evento do click para matricular
$(document).on('click', '#inserirNota', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma  = idTurma;

    // notas

    // Pegando a atividade 1
    var nota_atv1 = new Array();
    $('.1_ativ').each(function() {
        nota_atv1.push($(this).val());
    });

    // Pegando a atividade 2
    var nota_atv2 = new Array();
    $('.2_ativ').each(function() {
        nota_atv2.push($(this).val());
    });

    // Pegando a atividade 3
    var nota_atv3 = new Array();
    $('.3_ativ').each(function() {
        nota_atv3.push($(this).val());
    });

    // Pegando a verif. aprend.
    var verif_aprend = new Array();
    $('.verif_aprend').each(function() {
        verif_aprend.push($(this).val());
    });

    // Pegando a média
    var media = new Array();
    $('.media').each(function() {
        media.push($(this).val());
    });

    // Pegando a recup. paralela
    var recup_paralela = new Array();
    $('.recup_paralela').each(function() {
        recup_paralela.push($(this).val());
    });

    // Pegando a nota. recuper.
    var nota_recuper = new Array();
    $('.nota_recuper').each(function() {
        nota_recuper.push($(this).val());
    });

    // Pegando os ids da nota.
    var idNota = new Array();
    $('.idNota').each(function() {
        idNota.push($(this).val());
    });

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!aluno && !periodo) {
        swal("Oops...", "Você deve selecionar um aluno um período e uma disciplina!", "error");
        return false;
    }

    // Setando o o json para envio
    var dados = {
        'turma' : turma,
        'aluno' : idAluno,
        'periodo' : idPeriodo,
        'disciplinas' : idsDisciplina,
        'idNota' : idNota,

        // Notas
        'nota_ativ1' : nota_atv1,
        'nota_ativ2' : nota_atv2,
        'nota_ativ3' : nota_atv3,
        'nota_verif_aprend' : verif_aprend,
        'media' : media,
        'recup_paralela' : recup_paralela,
        'nota_para_recup' : nota_recuper
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.nota.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['return'].length > 0) {
            swal("Notas inseridas com sucesso!", "Click no botão abaixo!", "success");

            // Varrendo as notas existentes do aluno por disciplina
            for (var i = 0; i < json['return'].length; i++) {
                $(".1_ativ_" + json['return'][i]['disciplina_id']).val(json['return'][i]['nota_ativ1']);
                $(".2_ativ_" + json['return'][i]['disciplina_id']).val(json['return'][i]['nota_ativ2']);
                $(".3_ativ_" + json['return'][i]['disciplina_id']).val(json['return'][i]['nota_ativ3']);
                $(".verif_aprend_" + json['return'][i]['disciplina_id']).val(json['return'][i]['nota_verif_aprend']);
                $(".media_" + json['return'][i]['disciplina_id']).val(json['return'][i]['media']);
                $(".recup_paralela_" + json['return'][i]['disciplina_id']).val(json['return'][i]['recup_paralela']);
                $(".nota_recuper_" + json['return'][i]['disciplina_id']).val(json['return'][i]['nota_para_recup']);
                $(".idNota_" + json['return'][i]['disciplina_id']).val(json['return'][i]['id']);
            }

        } else {
            swal('Erro ao inserir a nota!', "Click no botão abaixo!", "error");
        }

    });

});

