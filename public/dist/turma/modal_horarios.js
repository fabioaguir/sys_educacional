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
            {data: 'dia', name: 'edu_dias_semana.nome'},
            {data: 'turno', name: 'edu_turnos.nome'},
            {data: 'hora', name: 'hora', orderable: false, searchable: false},
            {data: 'disciplina', name: 'edu_disciplinas.nome'},
            {data: 'professor', name: 'gen_cgm.nome'},
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
    dias("");

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


//Limpar os campos do formulário
function limparCamposHorarios()
{
    disciplinasHorario("", idTurma, idSerie);
    professores("", idEscola);
    dias("");
    $('#hora option').remove();
}



