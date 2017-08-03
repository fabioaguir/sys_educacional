// Carregando a table
var tableDisponibilidades;
function loadTableDisponibilidades (idServidor) {
    // Carregaando a grid
    tableDisponibilidades = $('#disponibilidades-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('servidor.gridDisponibilidade', {'id' :idServidor }),
        columns: [
            {data: 'turno', name: 'edu_turnos.nome'},
            {data: 'dia_semana', name: 'edu_dias_semana.nome'},
            {data: 'horario', name: 'horario', orderable: false, searchable: false},
            {data: 'escola', name: 'edu_escola.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableDisponibilidades;
}


// Função de execução
function runModalAdicionarDisponibilidades(idServidor)
{
    //Carregando as grids de situações
    if(tableDisponibilidades) {
        loadTableDisponibilidades(idServidor).ajax.url(laroute.route('servidor.gridDisponibilidade', {'id' :idServidor })).load();
    } else {
        loadTableDisponibilidades(idServidor);
    }

    // Carregando os campos selects
    escolasDisp("");
    dias("");
    turnos("");

    // Desabilitando o botão de editar
    $('#edtDisponibilidade').prop('disabled', true);
    $('#edtDisponibilidade').hide();

    // Exibindo o modal
    $('#modal-adicionar-disponibilidades').modal({'show' : true});
}

// Id do telefone
var idDisponibilidade;


//Evento do click no botão adicionar período
$(document).on('click', '#addDisponibilidade', function (event) {

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
        url: laroute.route('servidor.storeDisponibilidade'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Disponibilidade(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableDisponibilidades.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposDisponibilidade();
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
$(document).on('click', '#deleteDisponibilidade', function () {

    var idDisponibilidade = tableDisponibilidades.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idDisponibilidade' : idDisponibilidade
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.removerDisponibilidade', {'id' : idDisponibilidade}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Disponibilidade removida com sucesso!", "Click no botão abaixo!", "success");
        tableDisponibilidades.ajax.reload();
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
function limparCamposDisponibilidade()
{
    escolasDisp("");
    dias("");
    turnos("");
    horas("", "");
}



