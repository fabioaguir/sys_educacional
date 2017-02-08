// Carregando a table
var tableAtividades;
function loadTableAtividades (idServidor) {

    // Carregaando a grid
    tableAtividades = $('#atividades-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('servidor.gridAtividade', {'id' :idServidor }),
        columns: [
            {data: 'funcao', name: 'funcoes.nome'},
            {data: 'horas_manha', name: 'atividades.horas_manha'},
            {data: 'horas_tarde', name: 'atividades.horas_tarde'},
            {data: 'horas_noite', name: 'atividades.horas_noite'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAtividades;
}


// Função de execução
function runModalAdicionarAtividades(idServidor)
{
    //Carregando as grids de atividades
    if(tableAtividades) {
        loadTableAtividades(idServidor).ajax.url(laroute.route('servidor.gridAtividade', {'id' :idServidor })).load();
    } else {
        loadTableAtividades(idServidor);
    }

    // Carregando os campos selects
    funcoes("");

    // Desabilitando o botão de editar
    $('#edtAtividade').prop('disabled', true);
    $('#edtAtividade').hide();

    // Exibindo o modal
    $('#modal-adicionar-atividades').modal({'show' : true});
}

// Id da atividade
var idAtividade;


//Evento do click no botão adicionar atividade
$(document).on('click', '#addAtividade', function (event) {

    //Recuperando os valores dos campos do fomulário
    var horaManha = $('#horaManha').val();
    var horaTarde = $('#horaTarde').val();
    var horaNoite = $('#horaNoite').val();
    var funcao    = $('#funcao').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!funcao) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'horas_manha' : horaManha,
        'horas_tarde' : horaTarde,
        'horas_noite' : horaNoite,
        'funcoes_id' : funcao,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.storeAtividade'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Atividade de trabalho(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAtividades.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposAtividade();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtAtividade', function (event) {

    //Recuperando os valores dos campos do fomulário
    var horaManha = $('#horaManha').val();
    var horaTarde = $('#horaTarde').val();
    var horaNoite = $('#horaNoite').val();
    var funcao    = $('#funcao').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!funcao) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'horas_manha' : horaManha,
        'horas_tarde' : horaTarde,
        'horas_noite' : horaNoite,
        'funcoes_id' : funcao,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.updateAtividade', {'id' : idAtividade}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Atividade de trabalho(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAtividades.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposAtividade();

        // Desabilitando o botão de editar
        $('#edtAtividade').prop('disabled', true);
        $('#edtAtividade').hide();
        $('#addAtividade').show();

    });
});

//Evento de remover a formação
$(document).on('click', '#deleteAtividade', function () {

    var idAtividade = tableAtividades.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idAtividade' : idAtividade
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.removerAtividade', {'id' : idAtividade}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Atividade de trabalho removido com sucesso!", "Click no botão abaixo!", "success");
        tableAtividades.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar a formação
$(document).on("click", "#editarAtividade", function () {
    //Recuperando o id da Atividades
    idAtividade = tableAtividades.row($(this).parents('tr')).data().id;
    
    // Recuperando os dados da formação
    var horaManha = tableAtividades.row($(this).parents('tr')).data().horas_manha;
    var horaTarde = tableAtividades.row($(this).parents('tr')).data().horas_tarde;
    var horaNoite = tableAtividades.row($(this).parents('tr')).data().horas_noite;
    var funcao    = tableAtividades.row($(this).parents('tr')).data().funcao_id;

    // prenchendo o os campos de formação
    funcoes(funcao);
    $('#horaManha').val(horaManha);
    $('#horaTarde').val(horaTarde);
    $('#horaNoite').val(horaNoite);

    // Desabilitando o botão de editar
    $('#edtAtividade').prop('disabled', false);
    $('#edtAtividade').show();
    $('#addAtividade').hide();

});

//Limpar os campos do formulário
function limparCamposAtividade()
{
    funcoes("");
    $('#horaManha').val("");
    $('#horaTarde').val("");
    $('#horaNoite').val("");
}



