// Carregando a table
var tableRelacoes;
function loadTableRelacoes (idServidor) {
    // Carregaando a grid
    tableRelacoes = $('#relacoes-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('servidor.gridRelacao', {'id' :idServidor }),
        columns: [
            {data: 'regime', name: 'regime_trabalho.nome'},
            {data: 'area', name: 'area_trabalho.nome'},
            {data: 'niveis_ensino', name: 'niveis_ensino.nome'},
            {data: 'disciplina', name: 'disciplinas.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableRelacoes;
}


// Função de execução
function runModalAdicionarRelacoes(idServidor)
{
    //Carregando as grids de situações
    if(tableRelacoes) {
        loadTableRelacoes(idServidor).ajax.url(laroute.route('servidor.gridRelacao', {'id' :idServidor })).load();
    } else {
        loadTableRelacoes(idServidor);
    }

    // Desabilitando o botão de editar
    $('#edtRelacao').prop('disabled', true);
    $('#edtRelacao').hide();

    // Exibindo o modal
    $('#modal-adicionar-relacoes').modal({'show' : true});
}

// Id do telefone
var idRelacao;


//Evento do click no botão adicionar período
$(document).on('click', '#addRelacao', function (event) {

    //Recuperando os valores dos campos do fomulário
    var regime      = $('#regime').val();
    var area        = $('#area').val();
    var ensino      = $('#ensino').val();
    var disciplina  = $('#disciplina').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!regime || !area || !ensino || !disciplina) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'regime_trabalho_id' : regime,
        'area_trabalho_id' : area,
        'disciplinas_id' : disciplina,
        'niveis_ensino_id' : ensino,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.storeRelacao'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Relação de trabalho(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableRelacoes.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposRelacao();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtRelacao', function (event) {

    //Recuperando os valores dos campos do fomulário
    var regime      = $('#regime').val();
    var area        = $('#area').val();
    var ensino      = $('#ensino').val();
    var disciplina  = $('#disciplina').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!regime || !area || !ensino || !disciplina) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'regime_trabalho_id' : regime,
        'area_trabalho_id' : area,
        'disciplinas_id' : disciplina,
        'niveis_ensino_id' : ensino,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.updateRelacao', {'id' : idRelacao}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Relação de trabalho(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableRelacoes.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposRelacao();

        // Desabilitando o botão de editar
        $('#edtRelacao').prop('disabled', true);
        $('#edtRelacao').hide();
        $('#addRelacao').show();

    });
});

//Evento de remover o telefone
$(document).on('click', '#deleteRelacao', function () {

    var idRelacao = tableRelacoes.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idRelacao' : idRelacao
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.removerRelacao', {'id' : idRelacao}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Relação de trabalho removido com sucesso!", "Click no botão abaixo!", "success");
        tableRelacoes.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar o evento letivos
$(document).on("click", "#editarRelacao", function () {
    //Recuperando o id da relacao
    idRelacao = tableRelacoes.row($(this).parents('tr')).data().id;

    // Recuperando os dados do evento
    var regime      = tableRelacoes.row($(this).parents('tr')).data().regime_id;
    var area        = tableRelacoes.row($(this).parents('tr')).data().area_id;
    var ensino      = tableRelacoes.row($(this).parents('tr')).data().niveis_ensino_id;
    var disciplina  = tableRelacoes.row($(this).parents('tr')).data().disciplinas_id;

    // prenchendo o os campos de relação
    regimes(regime);
    areas(area);
    ensinos(ensino);
    disciplinas(disciplina);

    // Desabilitando o botão de editar
    $('#edtRelacao').prop('disabled', false);
    $('#edtRelacao').show();
    $('#addRelacao').hide();

});

//Limpar os campos do formulário
function limparCamposRelacao()
{
    regimes("");
    areas("");
    ensinos("");
    disciplinas("");
}



