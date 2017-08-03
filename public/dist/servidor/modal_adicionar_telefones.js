// Carregando a table
var tableTelefones;
function loadTableTelefones (idCgm) {
    // Carregaando a grid
    tableTelefones = $('#telefones-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('servidor.gridTelefone', {'id' :idCgm }),
        columns: [
            {data: 'nome', name: 'edu_telefones.nome'},
            {data: 'tipo', name: 'edu_tipo_telefones.nome'},
            {data: 'ramal', name: 'edu_telefones.ramal'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableTelefones;
}


// Função de execução
function runModalAdicionarTelefones(idCgm)
{
    //Carregando as grids de situações
    if(tableTelefones) {
        loadTableTelefones(idCgm).ajax.url(laroute.route('servidor.gridTelefone', {'id' :idCgm })).load();
    } else {
        loadTableTelefones(idCgm);
    }
    
    // Carregando os campos selects
    tipoTelefone("");

    // Desabilitando o botão de editar
    $('#edtTelefone').prop('disabled', true);
    $('#edtTelefone').hide();

    // Exibindo o modal
    $('#modal-adicionar-telefones').modal({'show' : true});
}

// Id do telefone
var idTelefone;


//Evento do click no botão adicionar período
$(document).on('click', '#addTelefone', function (event) {

    //Recuperando os valores dos campos do fomulário
    var tipoTelefone = $('#tipoTelefone').val();
    var nome       = $('#numero').val();
    var ramal  = $('#ramal').val();
    var observacao  = $('#observacao').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!tipoTelefone || !nome) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'tipo_telefones_id' : tipoTelefone,
        'nome' : nome,
        'ramal' : ramal,
        'observacao' : observacao,
        'cgm_id' : idCgm
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.storeTelefone'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Telefone(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableTelefones.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposTelefone();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtTelefone', function (event) {

    //Recuperando os valores dos campos do fomulário
    var tipoTelefone = $('#tipoTelefone').val();
    var nome       = $('#numero').val();
    var ramal  = $('#ramal').val();
    var observacao  = $('#observacao').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!tipoTelefone || !nome) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'tipo_telefones_id' : tipoTelefone,
        'nome' : nome,
        'ramal' : ramal,
        'observacao' : observacao,
        'cgm_id' : idCgm
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.updateTelefone', {'id' : idTelefone}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Telefone(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableTelefones.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposTelefone();

        // Desabilitando o botão de editar
        $('#edtTelefone').prop('disabled', true);
        $('#edtTelefone').hide();
        $('#addTelefone').show();

    });
});

//Evento de remover o telefone
$(document).on('click', '#deleteTelefone', function () {

    var idTelefone = tableTelefones.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idTelefone' : idTelefone
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.removerTelefone', {'id' : idTelefone}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Telefome removido com sucesso!", "Click no botão abaixo!", "success");
        tableTelefones.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar o evento letivos
$(document).on("click", "#editarTelefone", function () {
    //Recuperando o id do evento
    idTelefone = tableTelefones.row($(this).parents('tr')).data().id;

    // Recuperando os dados do evento
    var tpTelefone  = tableTelefones.row($(this).parents('tr')).data().tipo_id;
    var nome        = tableTelefones.row($(this).parents('tr')).data().nome;
    var ramal       = tableTelefones.row($(this).parents('tr')).data().ramal;
    var observacao  = tableTelefones.row($(this).parents('tr')).data().observacao;

    // prenchendo o os campos de evento
    tipoTelefone(tpTelefone);
    $('#numero').val(nome);
    $('#ramal').val(ramal);
    $('#observacao').val(observacao);

    // Desabilitando o botão de editar
    $('#edtTelefone').prop('disabled', false);
    $('#edtTelefone').show();
    $('#addTelefone').hide();

});

//Limpar os campos do formulário
function limparCamposTelefone()
{
    tipoTelefone("");
    $('#numero').val("");
    $('#ramal').val("");
    $('#observacao').val("");
}



