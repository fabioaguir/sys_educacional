// Variáveis globais
var idTurma, idAluno, idPeriodo, idDisciplina;
var nomeDisciplina, nomePeriodo;


//Evento do click para matricular
$(document).on('click', '#consultarNota', function (event) {


    // Pegando os ids das disciplinas

    //Recuperando os valores dos campos do fomulário
    idDisciplina    = $('#disciplina').val();
    idAluno         = $('#aluno').val();
    idPeriodo       = $('#periodo').val();

    nomeDisciplina  = $('select[id=disciplina] option:selected').text();
    nomePeriodo     = $('select[id=periodo] option:selected').text();

    $('#nomeDisciplina').text(nomeDisciplina);
    $('#nomePeriodo').text(nomePeriodo);

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!idDisciplina && !idPeriodo) {
        swal("Oops...", "Você deve selecionar um aluno um período e uma disciplina!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'turma' : idTurma,
        'periodo' : idPeriodo,
        'disciplina' : idDisciplina
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.notabydisciplina.consultar'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        var html = "";

        if (json['msg'] == 'success') {

            $(".notas").show();

            // Varre os alunos
            $.each( json['return'], function( keyAluno, valueAluno ) {
                html += "<tr>";
                html += "<td>" + valueAluno['nome'] + "</td>";

                // Nota 1
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['nota_ativ1'] != null ? valueAluno['notas']['nota_ativ1'] : "";
                    html += "<input style='width: 50px' class='nota' type='text' value='"+ nota +"' " +
                        "name='nota_ativ1-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"-"+ valueAluno['notas']['id'] +"'>";
                } else {
                    html += "<input style='width: 50px' class='nota' type='text' value='' " +
                        "name='nota_ativ1-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"'>";
                }
                html += '</td>';


                // Nota 2
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['nota_ativ2'] != null ? valueAluno['notas']['nota_ativ2'] : "";
                    html += "<input style='width: 50px' class='nota' type='text' value='"+ nota +"' " +
                        "name='nota_ativ2-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"-"+ valueAluno['notas']['id'] +"'>";
                } else {
                    html += "<input style='width: 50px' class='nota' type='text' value='' " +
                        "name='nota_ativ2-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"'>";
                }
                html += '</td>';


                // Nota 3
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['nota_ativ3'] != null ? valueAluno['notas']['nota_ativ3'] : "";
                    html += "<input style='width: 50px' class='nota' type='text' value='"+ nota +"' " +
                        "name='nota_ativ3-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"-"+ valueAluno['notas']['id'] +"'>";
                } else {
                    html += "<input style='width: 50px' class='nota' type='text' value='' " +
                        "name='nota_ativ3-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"'>";
                }
                html += '</td>';

                // Verif. de Aprend.
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['nota_verif_aprend'] != null ? valueAluno['notas']['nota_verif_aprend'] : "";
                    html += "<input style='width: 50px' class='nota' type='text' value='"+ nota +"' " +
                        "name='nota_verif_aprend-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"-"+ valueAluno['notas']['id'] +"'>";
                } else {
                    html += "<input style='width: 50px' class='nota' type='text' value='' " +
                        "name='nota_verif_aprend-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"'>";
                }
                html += '</td>';

                // Média
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['media'] != null ? valueAluno['notas']['media'] : "";
                    html += "<input style='width: 50px' disabled readonly class='nota' type='text' value='"+ nota +"' " +
                        "name='media'>";
                } else {
                    html += "<input style='width: 50px' disabled readonly class='nota' type='text' value='' " +
                        "name='media'>";
                }
                html += '</td>';

                // Recup. Paralela
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['recup_paralela'] != null ? valueAluno['notas']['recup_paralela'] : "";
                    html += "<input style='width: 50px' class='nota' type='text' value='"+ nota +"' " +
                        "name='recup_paralela-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"-"+ valueAluno['notas']['id'] +"'>";
                } else {
                    html += "<input style='width: 50px' class='nota' type='text' value='' " +
                        "name='recup_paralela-"+ valueAluno['id'] +"-"+ idDisciplina +"-"+ idPeriodo +"-"+ idTurma +"'>";
                }
                html += '</td>';

                // Nota P/ Recuper.
                html += '<td>';
                if (valueAluno['notas']) {
                    var nota = valueAluno['notas']['nota_para_recup'] != null ? valueAluno['notas']['nota_para_recup'] : "";
                    html += "<input style='width: 50px' disabled readonly class='nota' type='text' value='"+ nota +"' " +
                        "name='recuperacao'>";
                } else {
                    html += "<input style='width: 50px' disabled readonly class='nota' type='text' value='' " +
                        "name='recuperacao'>";
                }
                html += '</td>';

                html += "</tr>";
            });

            $('#table-nota tbody tr').remove();
            $('#table-nota tbody').append(html);

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

