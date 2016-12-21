//Evento do click no botão adicionar disciplina
$(document).on('click', '#addTurno', function (event) {
    // Recuperando o array do select2
    var array = $('#select-turnos').select2('data');

    // Verificando se alguma disciplina foi selecionada
    if (!array.length > 0) {
        swal("Oops...", "Você deve selecionar um Turno!", "error");
        return false;
    }

    // Array de ids
    var arrayId = [];

    // Percorrendo o array de dados
    for (var i = 0; i < array.length; i++) {
        arrayId[i] = array[i].id
    }

    //Setando o o json para envio
    var dados = {
        'idEscola' : idEscola,
        'idCurso': idCurso,
        'idTurnos' : arrayId
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('escola.turno.adicionarTurnos'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        // Limpando o select
        $('#select-turnos').val(null).trigger("change");

        // Mensagem de Retorno
        swal("Turno(s) adicionado(s) com sucesso!", "Click no botão abaixo!", "success");

        // Recarregando a drid de Cursos
        tableEscolaCurso.ajax.reload(function () {
            $('#cursos-grid tr').eq(indexSelectedRow).find('td').addClass('row_selected');
        });

        // Recarregando a grid de Turnos
        tableCursoTurno.ajax.reload();
    });
});

//Evento de remover a disciplina
$(document).on('click', '#removerTurno', function () {
    var idEscolaCursoTurno = tableCursoTurno.row($(this).parents('tr').index()).data().idEscolaCursoTurno;

    //Setando o o json para envio
    var dados = {
        'idEscolaCursoTurno' : idEscolaCursoTurno
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('escola.turno.removerTurno'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        // Limpando o select
        $('#select-turnos').val(null).trigger("change");

        // Mensagem de retorno
        swal("Turno(s) adicionado(s) com sucesso!", "Click no botão abaixo!", "success");

        // Recarregando a gride Cursos
        tableEscolaCurso.ajax.reload(function () {
            $('#cursos-grid tr').eq(indexSelectedRow).find('td').addClass('row_selected');
        });

        // Recarregando a grid de turnos
        tableCursoTurno.ajax.reload();
    });
});
