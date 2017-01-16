/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

//Função para listar as escolas
function escolasDisp(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getEscolas'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma escola</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#escolaDisp option').remove();
        $('#escolaDisp').append(option);
    });
}

//Função para listar os dias da semana
function dias(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getDias'),
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
}

//Função para listar os turnos
function turnos(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getTurnos'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um turno</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#turno option').remove();
        $('#turno').append(option);
    });
}

//Função para listar os horários
function horas(idTurno, id) {

    if (idTurno) {

        //Setando o o json para envio
        var dados = {
            'idTurno' : idTurno
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('servidor.getHoras'),
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
}

// Pegando os horários de acordo com o turno
$(document).on('change', '#turno', function(){

    var idTurno = $('#turno').val();

    if (idTurno) {

        //Setando o o json para envio
        var dados = {
            'idTurno' : idTurno
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('servidor.getHoras'),
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
        swal("Nenhum horário encontrado nesse turno", "error");
    }

});
