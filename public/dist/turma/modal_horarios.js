// Carregando a table
var tableHorarios;
function loadQuadroHorarios (idTurma) {


    var dados = {
        'turma_id' : idTurma
    };

    $('#img-loading-ajax').modal('show');

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.quadro'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        var html = "";

        $('#img-loading-ajax').modal('hide');

        $.each(json['horarios'], function( index, value ) {

            html += '<tr>';
            html += '<td style="background-color: #e4e4e4">' + value['hora'] + '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '2' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] +'><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>' :  '';
            });
            html += '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '3' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] +'><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>' :  '';
            });
            html += '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '4' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] + '><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>'  :  '';
            });
            html += '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '5' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] + '><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>'  :  '';
            });
            html += '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '6' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] + '><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>' :  '';
            });
            html += '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '7' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] + '><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>' :  '';
            });
            html += '</td>';

            html += '<td style="text-align: center">';
            $.each(json['disciplinas'], function( index, value2 ) {
                value2['dia_id'] == '1' && value2['hora_id'] == value['hora_id']
                    ?  html += '<span data='+ value2['id'] + '><b>' + value2['disciplina'] + '</b><br />'
                    + value2['professor'].substring(0, value2['professor'].indexOf(" ")) + '</span>' :  '';
            });
            html += '</td>';

            html += '</tr>';

        });

        $('#quadro-horarios tbody tr').remove();
        $('#quadro-horarios tbody').append(html);

    });

}

// Id do horario
var idHorario;

// Função de execução
function runModalHorarios(idTurma, idEscola, idSerie, idTurno)
{
    loadQuadroHorarios(idTurma);

    // Carregando os campos selects
    disciplinasHorario("");
    dias("");

    // ocultando botões
    $('.addHorario').show();
    $('.edtHorario').hide();
    $('.delHorario').hide();
    $('.canHorario').hide();

    // Exibindo o modal
    $('#modal-horarios').modal({'show' : true});

    if (profUnico == '2') {
        // Ocultando por padrão o campo disciplina
        $('#div-disciplina').hide();
    }

    //Limpar os campos do formulário
    limparCamposHorarios();

    idHorario = "";
}


//Carregar formulário com os dados para deletar e editar
$(document).on('click', 'td', function () {

    var id = $(this).children().attr('data');

    if(id) {

        // Requisição Ajax
        jQuery.ajax({
            type: 'GET',
            url: laroute.route('turma.horario.find', {'id' : id}),
            datatype: 'json'
        }).done(function (retorno) {

            dias(retorno['dia_semana_id']);
            disciplinasHorario(retorno['disciplinas_id']);
            horas(retorno['hora_id'], retorno['hora'], retorno['dia_semana_id']);
            professores(retorno['professor_id'], retorno['professor'], retorno['hora_id'], retorno['dia_semana_id']);
            idHorario = retorno['id'];

            // ocultando botões
            $('.addHorario').hide();
            $('.edtHorario').show();
            $('.delHorario').show();
            $('.canHorario').show();

        });

    } else {

        // ocultando botões
        $('.addHorario').show();
        $('.edtHorario').hide();
        $('.delHorario').hide();
        $('.canHorario').hide();

        //Limpar os campos do formulário
        limparCamposHorarios();

        idHorario = "";
    }

});


//Evento do click no botão adicionar horário
$(document).on('click', '#addHorario', function (event) {

    //Recuperando os valores dos campos do fomulário
    var disciplina   = $('#disciplina').val();
    var professor    = $('#professor').val();
    var dia          = $('#dia').val();
    var hora         = $('#hora').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!professor || !dia || !hora) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'horas_id' : hora,
        'turmas_id' : idTurma,
        'disciplinas_id' : disciplina,
        'servidor_id' : professor,
        'dia_semana_id' : dia,
        'tipo_turma' : profUnico
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Horário(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        loadQuadroHorarios(idTurma);
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposHorarios();

    });
});

//Evento do click no botão adicionar horário
$(document).on('click', '#edtHorario', function (event) {

    //Recuperando os valores dos campos do fomulário
    var disciplina   = $('#disciplina').val();
    var professor    = $('#professor').val();
    var dia          = $('#dia').val();
    var hora         = $('#hora').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!professor || !dia || !hora) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'horas_id' : hora,
        'turmas_id' : idTurma,
        'disciplinas_id' : disciplina,
        'servidor_id' : professor,
        'dia_semana_id' : dia,
        'tipo_turma' : profUnico
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.update', {'id' : idHorario}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Horário(s) alterado(s) com sucesso!", "Click no botão abaixo!", "success");
        loadQuadroHorarios(idTurma);
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposHorarios();

        // ocultando botões
        $('.addHorario').show();
        $('.edtHorario').hide();
        $('.delHorario').hide();
        $('.canHorario').hide();
    });
});

//Evento de remover o telefone
$(document).on('click', '#delHorario', function () {

    //Setando o o json para envio
    var dados = {
        'idHorario' : idHorario
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.remover', {'id' : idHorario}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Horário removida com sucesso!", "Click no botão abaixo!", "success");
        loadQuadroHorarios(idTurma);
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposHorarios();

        // ocultando botões
        $('.addHorario').show();
        $('.edtHorario').hide();
        $('.delHorario').hide();
        $('.canHorario').hide();
    });
});

//Evento de remover o telefone
$(document).on('click', '#canHorario', function () {

    //Limpar os campos do formulário
    limparCamposHorarios();

    // ocultando botões
    $('.addHorario').show();
    $('.edtHorario').hide();
    $('.delHorario').hide();
    $('.canHorario').hide();

    idHorario = "";
});

//Limpar os campos do formulário
function limparCamposHorarios()
{
    disciplinasHorario("", idTurma, idSerie);
    dias("");
    $('#hora option').remove();
    $('#professor option').remove();
}



