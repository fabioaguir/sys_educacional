/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

//Global idAluno
var idAluno, idSerie, idEscola, idMatricula, idTurma;

//Função para listar as turmas
function turmas(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('aluno.getTurma'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma turma</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#turma option').remove();
        $('#turma').append(option);
    });
}

turmas("");

//Função para listar as turmas
function turmaParaMudancaTurma(idTurma, idSerie, idEscola) {

    var dados = {
        'idTurma': idTurma,
        'idSerie': idSerie,
        'idEscola': idEscola
    };

    jQuery.ajax({
        type: 'POST',
        url: laroute.route('aluno.getTurmaMudanca'),
        datatype: 'json',
        data: dados
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma turma</option>';
        for (var j = 0; j < json.length; j++) {
            option += '<option value="' + json[j]['id'] + '">' + json[j]['nome'] + '</option>';
        }

        $('#turma_mudanca option').remove();
        $('#turma_mudanca').append(option);
    });
}
