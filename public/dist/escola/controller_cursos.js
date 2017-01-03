//Evento do click no botão adicionar disciplina
$(document).on('click', '#addCurso', function (event) {
    // Recuperando o array do select2
    var array = $('#select-cursos').select2('data');

    // Verificando se alguma disciplina foi selecionada
    if (!array.length > 0) {
        swal("Oops...", "Você deve selecionar um Curso!", "error");
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
        'idCursos' : arrayId
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('escola.curso.adicionarCursos'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        // Limpando o select
        $('#select-cursos').val(null).trigger("change");

        // Mensagem de retorno
        swal("Curso(s) adicionado(s) com sucesso!", "Click no botão abaixo!", "success");

        // Desabilitando a o select2 e o botão de adicionar
        $('#select-turnos').prop('disabled', true);
        $('#addTurno').prop('disabled', true);

        // Zerando a grid de disciplinas
        loadTableCursoTurno(0).ajax.url(laroute.route('escola.turno.gridTurnos', {'idEscolaCurso' :idEscolaCurso })).load();

        // Recarregando as grids
        tableEscolaCurso.ajax.reload();
        table.ajax.reload();
    });
});

//Evento de remover a disciplina
$(document).on('click', '#removerCurso', function () {
    var idEscolaCurso = tableEscolaCurso.row($(this).parents('tr').index()).data().idEscolaCurso;

    //Setando o o json para envio
    var dados = {
        'idEscolaCurso' : idEscolaCurso
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('escola.curso.removerCurso'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        // Limpando o select
        $('#select-cursos').val(null).trigger("change");

        // Desabilitando a o select2 e o botão de adicionar
        $('#select-turnos').prop('disabled', true);
        $('#addTurno').prop('disabled', true);

        // Menagem de retorno
        swal("Curso removido com sucesso!", "Click no botão abaixo!", "success");

        // Zerando a grid de disciplinas
        loadTableCursoTurno(0).ajax.url(laroute.route('escola.turno.gridTurnos', {'idEscolaCurso' :idEscolaCurso })).load();

        // recaregando as grids
        tableEscolaCurso.ajax.reload();
        table.ajax.reload();
    });
});
