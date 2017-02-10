// Carregando a table
var tableHorarios;
function loadTableHorarios (idTurma) {
    // Carregaando a grid
    tableHorarios = $('#horarios-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turma.horario.grid', {'idTurma' :idTurma }),
        columns: [
            {data: 'dia', name: 'dias_semana.nome'},
            {data: 'turno', name: 'turnos.nome'},
            {data: 'hora', name: 'hora', orderable: false, searchable: false},
            {data: 'disciplina', name: 'disciplinas.nome'},
            {data: 'professor', name: 'cgm.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableHorarios;
}


// Função de execução
function runModalHorarios(idTurma, idEscola, idSerie, idTurno)
{
    //Carregando as grids de situações
    if(tableHorarios) {
        loadTableHorarios(idTurma).ajax.url(laroute.route('turma.horario.grid', {'idTurma' :idTurma })).load();
    } else {
        loadTableHorarios(idTurma);
    }

    // Carregando os campos selects
    disciplinasHorario("", idTurma, idSerie);
    professores("", idEscola);
    
    // Desabilitando o botão de editar
    //$('#edtDisponibilidade').prop('disabled', true);
    //$('#edtDisponibilidade').hide();

    // Exibindo o modal
    $('#modal-horarios').modal({'show' : true});
}

// Id do horario
var idHoraro;


//Evento do click no botão adicionar período
$(document).on('click', '#addHorario', function (event) {

    //Recuperando os valores dos campos do fomulário
    var disciplina   = $('#disciplina').val();
    var professor    = $('#professor').val();
    var dia          = $('#dia').val();
    var hora         = $('#hora').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!disciplina || !professor || !dia || !hora) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'horas_id' : hora,
        'turmas_id' : idTurma,
        'disciplinas_id' : disciplina,
        'servidor_id' : professor,
        'dia_semana_id' : dia
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.horario.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Horário(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableHorarios.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposHorarios();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtDisponibilidade', function (event) {

    //Recuperando os valores dos campos do fomulário
    var escola   = $('#escolaDisp').val();
    var dia      = $('#dia').val();
    var hora     = $('#hora').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!escola || !hora || !dia) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'escola_id' : escola,
        'dia_semana_id' : dia,
        'hora_id' : hora,
        'servidor_id' : idServidor,
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.updateDisponibilidade', {'id' : idDisponibilidade}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Disponibilidade(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableDisponibilidades.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposDisponibilidade();

        // Desabilitando o botão de editar
        $('#edtDisponibilidade').prop('disabled', true);
        $('#edtDisponibilidade').hide();
        $('#addDisponibilidade').show();

    });
});

//Evento de remover o telefone
$(document).on('click', '#deleteHorario', function () {

    var idHorario = tableHorarios.row($(this).parents('tr').index()).data().id;

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
        tableHorarios.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar o evento letivos
$(document).on("click", "#editarDisponibilidade", function () {
    //Recuperando o id da relacao
    idDisponibilidade = tableDisponibilidades.row($(this).parents('tr')).data().id;

    // Recuperando os dados do evento
    var escola  = tableDisponibilidades.row($(this).parents('tr')).data().escola_id;
    var dia     = tableDisponibilidades.row($(this).parents('tr')).data().dia_semana_id;
    var turno   = tableDisponibilidades.row($(this).parents('tr')).data().turno_id;
    var hora    = tableDisponibilidades.row($(this).parents('tr')).data().hora_id;

    // prenchendo o os campos de relação
    escolasDisp(escola);
    dias(dia);
    turnos(turno);
    horas(turno, hora);

    // Desabilitando o botão de editar
    $('#edtDisponibilidade').prop('disabled', false);
    $('#edtDisponibilidade').show();
    $('#addDisponibilidade').hide();

});

//Limpar os campos do formulário
function limparCamposHorarios()
{
    disciplinasHorario("", idTurma, idSerie);
    professores("", idEscola);
    $('#dia option').remove();
    $('#hora option').remove();
}



