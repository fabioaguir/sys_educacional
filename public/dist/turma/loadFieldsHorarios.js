/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

//Função para listar as disciplinas
function disciplinasHorario(id, idTurma, idSerie) {
    
    var dados = {
        'idTurma' : idTurma,
        'idSerie' : idSerie
    };
    
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.getDisciplinas'),
        datatype: 'json',
        data: dados
    }).done(function (json) {
        var option = '';

        console.log(json[0]['id']);

        option += '<option value="">Selecione uma disciplna</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#disciplina option').remove();
        $('#disciplina').append(option);
    });
}

//Função para listar os professores
function professores(id, idEscola) {

    var dados = {
        'idEscola' : idEscola,
    };

    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.getProfessores'),
        datatype: 'json',
        data: dados
    }).done(function (json) {
        var option = '';

        console.log(json[0]['id']);

        option += '<option value="">Selecione um professor</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
            option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
            option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#professor option').remove();
        $('#professor').append(option);
    });
}

//Função para listar os dias da semana
/*function dias(id) {
    
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.getDias'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um dia</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#dia option').remove();
        $('#dia').append(option);
    });
}*/

//Função para listar os horários
/*function horas(id, idTurno) {

    if (idTurno) {

        //Setando o o json para envio
        var dados = {
            'idTurno' : idTurno
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.horario.getHoras'),
            datatype: 'json',
        }).done(function (json) {
            var option = '';

            option += '<option value="">Selecione um horário</option>';
            for (var i = 0; i < json.length; i++) {
                if (json[i]['id'] == id) {
                    option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                } else {
                    option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                }
            }

            $('#hora option').remove();
            $('#hora').append(option);
        });
        
    } else {
        $('#hora option').remove();
    }
}*/

// Pegando os dias disponíveis para um determinado professor
$(document).on('change', '#professor', function(){

    var idProfessor = $(this).val();

    if (idProfessor) {

        //Setando o o json para envio
        var dados = {
            'idProfessor' : idProfessor,
            'idEscola' : idEscola,
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.horario.getDias'),
            datatype: 'json',
        }).done(function (json) {
            var option = '';
            
            option += '<option value="">Selecione um dia</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#dia option').remove();
            $('#dia').append(option);
        });

    } else {
        swal("Nenhum dia encontrado para esse professor", "error");
    }

});

// Pegando os horários disponíveis para um determinado professor
$(document).on('change', '#dia', function(){

    var idDia = $(this).val();
    var idProfessor = $("#professor").val();

    if (idDia && idProfessor) {

        //Setando o o json para envio
        var dados = {
            'idDia' : idDia,
            'idEscola' : idEscola,
            'idProfessor' : idProfessor,
            'idTurno' : idTurno
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.horario.getHoras'),
            datatype: 'json',
        }).done(function (json) {
            var option = '';

            option += '<option value="">Selecione um horário</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#hora option').remove();
            $('#hora').append(option);
        });

    } else {
        swal("Nenhum horário encontrado para esse professor", "error");
    }

});
