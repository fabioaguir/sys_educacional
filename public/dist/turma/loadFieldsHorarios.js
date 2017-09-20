/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

// Global idTurma
var idTurma, idEscola, idSerie, idTurno, nomeSerie, idsAlunos;

//Função para listar as disciplinas
function disciplinasHorario(id) {
    
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
function dias(id) {

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
}


//Função para listar os professores
function horas(id, hora, dia) {

    if (dia) {

        //Setando o o json para envio
        var dados = {
            'idDia'   : dia,
            'idTurno' : idTurno,
            'idTurma' : idTurma
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.horario.getHoras'),
            datatype: 'json'
        }).done(function (json) {
            var option = '';

            option += '<option value="'+ id +'">' + hora + '</option>';
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

    }
}


//Função para listar os professores
function professores(id, professor, hora, dia) {

    if (hora && dia) {

        //Setando o o json para envio
        var dados = {
            'idDia'    : dia,
            'idHora'   : hora,
            'idEscola' : idEscola
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.horario.getProfessores'),
            datatype: 'json'
        }).done(function (json) {
            var option = '';

            option += '<option value="'+ id +'">' + professor + '</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#professor option').remove();
            $('#professor').append(option);
        });

    }
}

// Pegando os professores que ainda não
$(document).on('change', '#hora', function(){

    var idHora = $(this).val();
    var idDia = $("#dia").val();

    if (idDia && idHora) {

        //Setando o o json para envio
        var dados = {
            'idDia' : idDia,
            'idHora' : idHora,
            'idEscola' : idEscola
        };

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: laroute.route('turma.horario.getProfessores'),
            datatype: 'json'
        }).done(function (json) {
            var option = '';

            option += '<option value="">Selecione um horário</option>';
            for (var i = 0; i < json.length; i++) {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }

            $('#professor option').remove();
            $('#professor').append(option);
        });

    } else {
        swal("Nenhum professor disponível para esse dia e horário", "error");
    }

});

// Pegando os horários disponíveis para um determinado professor
$(document).on('change', '#dia', function(){

    var idDia = $(this).val();
    var idProfessor = $("#professor").val();

    if (idDia) {

        //Setando o o json para envio
        var dados = {
            'idDia'   : idDia,
            'idTurno' : idTurno,
            'idTurma' : idTurma
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

// Ação para adaptar a montagem do horário de acordo com a série/ano da turma
$(document).on('change', '#tipo-turma', function(){

    var valor = $(this).val();

    if (valor == '1') {
        $('#div-disciplina').show();
    } else if (!valor || valor == '2') {
        $('#div-disciplina').hide();
    }

});


// ############################################################################################################

//Função para pegar as series para matrícula
function periodos(id, idTurma) {

    var dados = {
        'idTurma' : idTurma
    };

    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.concelho.getPeriodos'),
        datatype: 'json',
        data: dados
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um período</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#periodo option').remove();
        $('#periodo').append(option);
    });
}

// ############################################################################################################

//Função para pegar as series para matrícula
function series(id, idSerie) {

    var dados = {
        'idSerie' : idSerie
    };

    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.historico.getSerie'),
        datatype: 'json',
        data: dados
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma série</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#serie-historico option').remove();
        $('#serie-historico').append(option);
    });
}


// Pegando as turmas para matricula
$(document).on('change', '#serie-historico', function() {

    var idSerie = $(this).val();

    var dados = {
        'idSerie' : idSerie,
        'idEscola' : idEscola
    };

    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.historico.getTurma'),
        datatype: 'json',
        data: dados
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma turma</option>';
        for (var i = 0; i < json.length; i++) {
            option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
        }

        $('#turma-historico option').remove();
        $('#turma-historico').append(option);
    });

});

//Evento para pegar o dia da semana da data de feriado informado
$(document).on('change', '#turma-historico', function () {

    // Recuperando o valor da data inicial
    var turma = $(this).val();

    //Setando o o json para envio
    var dados = {
        'turma' : turma
    };

    if (turma) {

        // Requisição Ajax
        jQuery.ajax({
            type: 'POST',
            url: laroute.route('turma.historico.getDadosTurma'),
            data: dados,
            datatype: 'json'
        }).done(function (retorno) {

            $('#turno-historico').val(retorno['dados']['turno']);
            $('#vagas-historico').val(retorno['dados']['vagas']);
            $('#matriculados-historico').val(retorno['qtdAlunos']);
            $('#vagas-restantes-historico').val(retorno['vRestantes']);

        });

    } else {
        $('#turno-historico').val("");
        $('#vagas-historico').val("");
        $('#matriculados-historico').val("");
        $('#vagas-restantes-historico').val("");
    }


});