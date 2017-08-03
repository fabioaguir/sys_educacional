// Carregando a table
var tableEventos;
function loadTableEventos (idCalendario) {
    // Carregaando a grid
    tableEventos = $('#eventos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: true,
        autoWidth: false,
        ajax: laroute.route('calendario.gridEvento', {'id' :idCalendario }),
        columns: [
            {data: 'nome', name: 'edu_feriados_eventos.nome'},
            {data: 'data_feriado', name: 'edu_feriados_eventos.data_feriado'},
            {data: 'dia_semana', name: 'edu_feriados_eventos.dia_semana'},
            {data: 'dia_letivo', name: 'edu_dia_letivo.nome'},
            {data: 'edu_tipo_evento', name: 'edu_tipo_evento.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableEventos;
}


// Função de execução
function runModalAdicionarEventos(idCalendario)
{
    //Carregando as grids de situações
    if(tableEventos) {
        loadTableEventos(idCalendario).ajax.url(laroute.route('calendario.gridEvento', {'id' :idCalendario })).load();
    } else {
        loadTableEventos(idCalendario);
    }

    // Carregando os selects
    diaLetivo("");
    
    // Desabilitando o botão de editar
    $('#edtEvento').prop('disabled', true);
    $('#edtEvento').hide();

    // Exibindo o modal
    $('#modal-adicionar-eventos').modal({'show' : true});
}

// Id do evento
var idEvento;


//Evento do click no botão adicionar período
$(document).on('click', '#addEvento', function (event) {

    //Recuperando os valores dos campos do fomulário
    var tipoEvento = $('#tipoEvento').val();
    var nome       = $('#nome').val();
    var dtFeriado  = $('#dtFeriado').val();
    var diaSemana  = $('#diaSemana').val();
    var diaLetivo  = $('#diaLetivo').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!tipoEvento || !nome || !dtFeriado || !diaLetivo) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'tipo_evento_id' : tipoEvento,
        'nome' : nome,
        'data_feriado' : dtFeriado,
        'dia_semana' : diaSemana,
        'dia_letivo_id' : diaLetivo,
        'calendarios_id' : idCalendario
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.storeEvento'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Eventos(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableEventos.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposEvento();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtEvento', function (event) {

    //Recuperando os valores dos campos do fomulário
    var tipoEvento = $('#tipoEvento').val();
    var nome       = $('#nome').val();
    var dtFeriado  = $('#dtFeriado').val();
    var diaSemana  = $('#diaSemana').val();
    var diaLetivo  = $('#diaLetivo').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!tipoEvento || !nome || !dtFeriado || !diaLetivo) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'tipo_evento_id' : tipoEvento,
        'nome' : nome,
        'data_feriado' : dtFeriado,
        'dia_semana' : diaSemana,
        'dia_letivo_id' : diaLetivo,
        'calendarios_id' : idCalendario
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.updateEvento', {'id' : idEvento}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Eventos(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableEventos.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposEvento();

        // Desabilitando o botão de editar
        $('#edtEvento').prop('disabled', true);
        $('#edtEvento').hide();
        $('#addEvento').show();

    });
});

//Evento de remover a evento letivos
$(document).on('click', '#deleteEvento', function () {

    var idEventoLetivo = tableEventos.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idEvento' : idEventoLetivo
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.removerEvento', {'id' : idEventoLetivo}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Disciplina removida com sucesso!", "Click no botão abaixo!", "success");
        tableEventos.ajax.reload();
        table.ajax.reload();
    });
});


//Evento para pegar o dia da semana da data de feriado informado
$(document).on('change', '#dtFeriado', function () {
    
    // Recuperando o valor da data inicial
    var data = $('#dtFeriado').val();

    //Setando o o json para envio
    var dados = {
        'data' : data
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.getDiaSemana'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {

        $('#diaSemana').val(retorno);
        
    });

});

// Evento para editar o evento letivos
$(document).on("click", "#editarEvento", function () {
    //Recuperando o id do evento
    idEvento = tableEventos.row($(this).parents('tr')).data().id;

    // Recuperando os dados do evento
    var tpEvento = tableEventos.row($(this).parents('tr')).data().tipo_evento_id;
    var nome   = tableEventos.row($(this).parents('tr')).data().nome;
    var dataFeriado   = tableEventos.row($(this).parents('tr')).data().data_feriado;
    var diaSemana   = tableEventos.row($(this).parents('tr')).data().dia_semana;
    var dLetivo   = tableEventos.row($(this).parents('tr')).data().dia_letivo_id;

    // prenchendo o os campos de evento
    tipoEvento(tpEvento);
    diaLetivo(dLetivo);
    $('#nome').val(nome);
    $('#dtFeriado').val(dataFeriado);
    $('#diaSemana').val(diaSemana);

    // Desabilitando o botão de editar
    $('#edtEvento').prop('disabled', false);
    $('#edtEvento').show();
    $('#addEvento').hide();

});

//Limpar os campos do formulário
function limparCamposEvento()
{
    tipoEvento("");
    diaLetivo("");
    $('#nome').val("");
    $('#dtFeriado').val("");
    $('#diaSemana').val("");
}



