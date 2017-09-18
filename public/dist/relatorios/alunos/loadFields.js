/**
 * Created by fabio_000 on 18/09/2017.
 */

function calendarios(id) {

    jQuery.ajax({
        type: 'POST',
        url: "/index.php/loadfields/getCalendarios",
        datatype: 'json'
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um calendário</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#calendario_id option').remove();
        $('#calendario_id').append(option);
    });

}


// Pegando os professores que ainda não
$(document).on('change', '#calendario_id', function(){

    var calendario = $(this).val();

    if (calendario) {

        //Setando o o json para envio
        var dados = {
            'calendario_id' : calendario
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: "/index.php/loadfields/getTurmaByCalendario",
            datatype: 'json'
        }).done(function (json) {
            var option = '';

            option += '<option value="">Selecione uma turma</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#turma_id option').remove();
            $('#turma_id').append(option);
        });

    } else {
        swal("Nenhuma turma disponível para esse calendário", "error");
    }

});

// Pegando os professores que ainda não
$(document).on('change', '#turma_id', function(){

    var turma = $(this).val();

    if (turma) {

        //Setando o o json para envio
        var dados = {
            'turma_id' : turma
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: "/index.php/loadfields/getAlunosByTurma",
            datatype: 'json'
        }).done(function (json) {
            var option = '';

            option += '<option value="">Selecione uma turma</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#aluno_id option').remove();
            $('#aluno_id').append(option);
        });

    } else {
        swal("Nenhum aluno disponível para essa turma", "error");
    }

});