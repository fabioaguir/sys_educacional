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
        $('#select-cursos').val(null).trigger("change");
        swal("Curso(s) adicionado(s) com sucesso!", "Click no botão abaixo!", "success");
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
        $('#select-cursos').val(null).trigger("change");
        swal("Curso removido com sucesso!", "Click no botão abaixo!", "success");
        tableEscolaCurso.ajax.reload();
        table.ajax.reload();
    });
});
