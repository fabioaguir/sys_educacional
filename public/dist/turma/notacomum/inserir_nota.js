// Variáveis globais
var idTurma, idAluno, idPeriodo, idDisciplina, idNota;
var nomeAluno, nomePeriodo, nomeDisciplina;


//Evento do click para matricular
$(document).on('click', '#consultarNota', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma  = idTurma;
    idAluno  = $('#aluno').val();
    idPeriodo = $('#periodo').val();
    idDisciplina = $('#disciplina').val();

    nomeAluno       = $('select[id=aluno] option:selected').text();
    nomeDisciplina  = $('select[id=disciplina] option:selected').text();
    nomePeriodo     = $('select[id=periodo] option:selected').text();

    console.log(nomeAluno);

    $('#nomeAluno').text(nomeAluno);
    $('#nomeDisciplina').text(nomeDisciplina);
    $('#nomePeriodo').text(nomePeriodo);

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!idAluno || !idPeriodo || !idDisciplina) {
        swal("Oops...", "Você deve selecionar um aluno um período e uma disciplina!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'turma' : turma,
        'aluno' : idAluno,
        'periodo' : idPeriodo,
        'disciplina' : idDisciplina
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.nota.consultar'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if(json['return']) {

            $('#1_ativ').val(json['return']['nota_ativ1']);
            $('#2_ativ').val(json['return']['nota_ativ2']);
            $('#3_ativ').val(json['return']['nota_ativ3']);
            $('#verif_aprend').val(json['return']['nota_verif_aprend']);
            $('#media').val(json['return']['media']);
            $('#recup_paralela').val(json['return']['recup_paralela']);
            $('#nota_recuper').val(json['return']['nota_para_recup']);

            idNota = json['return']['id'];

        } else {
            idNota = "";
            $('.nota').val('');
        }

    });

});


//Evento do click para matricular
$(document).on('click', '#inserirNota', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma  = idTurma;

    // notas
    var nota_atv1       = $('#1_ativ').val();
    var nota_atv2       = $('#2_ativ').val();
    var nota_atv3       = $('#3_ativ').val();
    var verif_aprend    = $('#verif_aprend').val();
    var media           = $('#media').val();
    var recup_paralela  = $('#recup_paralela').val();
    var nota_recuper    = $('#nota_recuper').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!aluno || !periodo || !disciplina) {
        swal("Oops...", "Você deve selecionar um aluno um período e uma disciplina!", "error");
        return false;
    }

    // Setando o o json para envio
    var dados = {
        'turma_id' : turma,
        'aluno_id' : idAluno,
        'periodo_id' : idPeriodo,
        'disciplina_id' : idDisciplina,
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

        if (json['return']) {
            swal("Nota inserida com sucesso!", "Click no botão abaixo!", "success");

            $('#1_ativ').val(json['return']['nota_ativ1']);
            $('#2_ativ').val(json['return']['nota_ativ2']);
            $('#3_ativ').val(json['return']['nota_ativ3']);
            $('#verif_aprend').val(json['return']['nota_verif_aprend']);
            $('#media').val(json['return']['media']);
            $('#recup_paralela').val(json['return']['recup_paralela']);
            $('#nota_recuper').val(json['return']['nota_para_recup']);

            idNota = json['return']['id'];

        } else {
            swal('Erro ao inserir a nota!', "Click no botão abaixo!", "error");
        }


    });

});