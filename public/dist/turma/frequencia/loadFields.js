/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

// Global idTurma
var idTurma, idProfessor, idDisciplina, dataInicio;


// Pegando os horários disponíveis para um determinado professor
$(document).on('change', '#professor', function(){

    var idProfessor = $(this).val();

    if (idProfessor) {

        //Setando o o json para envio
        var dados = {
            'idProfessor' : idProfessor,
            'idTurma' : idTurma
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.frequencia.getDisciplinas'),
            datatype: 'json'
        }).done(function (json) {
            var option = '';

            option += '<option value="">Selecione uma disciplina</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#disciplina option').remove();
            $('#disciplina').append(option);
        });

    } else {
        swal("Nenhuma disciplina encontrada para esse professor", "error");
    }

});
