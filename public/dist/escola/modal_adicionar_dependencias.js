// Carregando a table
var tableDependencias;
function loadTableDependencias (idEscola) {
    // Carregaando a grid
    tableDependencias = $('#dependencias-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('dependencia.grid', {'id' :idEscola }),
        columns: [
            {data: 'nome', name: 'nome'},
            {data: 'capacidade', name: 'capacidade'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableDependencias;
}


// Função de execução
function runModalAdicionarDependencias(idEscola)
{
    //Carregando as grids de situações
    if(tableDependencias) {
        loadTableDependencias(idEscola).ajax.url(laroute.route('dependencia.grid', {'id' :idEscola })).load();
    } else {
        loadTableDependencias(idEscola);
    }

    // Desabilitando o botão de editar
    $('#edtDependencia').prop('disabled', true);
    $('#edtDependencia').hide();

    // Exibindo o modal
    $('#modal-adicionar-dependencias').modal({'show' : true});
}

// Id do telefone
var idDependencia;


//Evento do click no botão adicionar período
$(document).on('click', '#addDependencia', function (event) {

    //Recuperando os valores dos campos do fomulário
    var nome        = $('#nome').val();
    var capacidade  = $('#capacidade').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!nome || !capacidade) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'nome' : nome,
        'capacidade' : capacidade,
        'escola_id' : idEscola
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('dependencia.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Dependência(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableDependencias.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposDependencia();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtDependencia', function (event) {

    //Recuperando os valores dos campos do fomulário
    var nome        = $('#nome').val();
    var capacidade  = $('#capacidade').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!nome || !capacidade) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'nome' : nome,
        'capacidade' : capacidade,
        'escola_id' : idEscola
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('dependencia.update', {'id' : idDependencia}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Telefone(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableDependencias.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposDependencia();

        // Desabilitando o botão de editar
        $('#edtDependencia').prop('disabled', true);
        $('#edtDependencia').hide();
        $('#addDependencia').show();

    });
});

//Evento de remover o telefone
$(document).on('click', '#deleteDependencia', function () {

    var idDependencia = tableDependencias.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idDependencia' : idDependencia
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('dependencia.destroy', {'id' : idDependencia}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Telefome removido com sucesso!", "Click no botão abaixo!", "success");
        tableDependencias.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar o evento letivos
$(document).on("click", "#editarDependencia", function () {
    //Recuperando o id do evento
    idDependencia = tableDependencias.row($(this).parents('tr')).data().id;

    // Recuperando os dados do evento
    var nome        = tableDependencias.row($(this).parents('tr')).data().nome;
    var capacidade  = tableDependencias.row($(this).parents('tr')).data().capacidade;

    // prenchendo o os campos de evento
    $('#nome').val(nome);
    $('#capacidade').val(capacidade);

    // Desabilitando o botão de editar
    $('#edtDependencia').prop('disabled', false);
    $('#edtDependencia').show();
    $('#addDependencia').hide();

});

//Limpar os campos do formulário
function limparCamposDependencia()
{
    $('#nome').val("");
    $('#capacidade').val("");
}



