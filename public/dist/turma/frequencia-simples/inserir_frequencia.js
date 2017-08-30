
// Global idTurma
var idTurma, idProfessor, dataInicio;

//Evento do click para matricular
$(document).on('click', '#consultarFrequencia', function (event) {


    //Recuperando os valores dos campos do fomulário
    var turma    = idTurma;
    idProfessor  = $('#professor').val();
    dataInicio   = $('#data_inicio').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!dataInicio) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o  json para envio
    var dados = {
        'turma' : turma,
        'professor' : idProfessor,
        'dataInicio' : dataInicio
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.frequenciasimples.consultar'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if(json['return']) {

            var html = "";

            // início - thead
            html += "<thead>";
            html += "<tr>";
            html += "<th>ALUNOS</th>";

            $.each( json['aulas'], function( key, value ) {
                html += "<th>"+ key +"</th>";
            });

            html += "</tr></thead>";
            // fim - thead

            // início - tbody
            html += "<tbody>";

            // Varre os alunos
            $.each( json['alunos'], function( keyAluno, valueAluno ) {
                html += "<tr>";
                html += "<td>"+ valueAluno['nome'] + "</td>";

                // Varre os dias da semana contido no registro de cada alunos
                $.each( valueAluno['aulas'], function( keyDia, valueDia ) {
                    html += "<td>";

                    // Varre as aulas contidas em cada registro de dia de cada aluno
                    $.each( valueDia, function( key, value ) {
                        if(value['falta'] == '1') {
                            html += "<label for='horario_"+ valueAluno['id'] +"_"+ keyDia +"_"+ value['id'] +"' class='checkbox checkbox-inline m-r-20'>";
                            html += "<input disabled type='checkbox' checked id='horario_"+ valueAluno['id'] +"_"+ keyDia +"_"+ value['id'] +"'  name='horario_"+ valueAluno['id'] +"_"+ keyDia +"_"+ value['id'] +"'>";
                            html += "<i class='input-helper'></i>";
                            html += value['nome'] + "</label>";
                        } else {
                            html += "<label for='horario_"+ valueAluno['id'] +"_"+ keyDia +"_"+ value['id'] +"' class='checkbox checkbox-inline m-r-20'>";
                            html += "<input type='checkbox' id='horario_"+ valueAluno['id'] +"_"+ keyDia +"_"+ value['id'] +"'  name='horario_"+ valueAluno['id'] +"_"+ keyDia +"_"+ value['id'] +"'>";
                            html += "<i class='input-helper'></i>";
                            html += value['nome'] + "</label>";
                        }
                    });

                    html += "</td>";
                });

                html += "</tr>";
            });

            html += "</tbody>";
            // fim - tbody

            $('#table-frequencia thead').remove();
            $('#table-frequencia tbody').remove();
            $('#table-frequencia').append(html);
        } else {

            $('#table-frequencia thead').remove();
            $('#table-frequencia tbody').remove();

            swal("Oops...", json['msg'], "error");
        }

    });

});

