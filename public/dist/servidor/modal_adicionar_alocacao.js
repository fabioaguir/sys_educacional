// Carregando a table
var tableAlocacoes;
function loadTableAlocacoes (idServidor) {
    // Carregaando a grid
    tableAlocacoes = $('#alocacoes-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('servidor.gridAlocacao', {'id' :idServidor }),
        columns: [
            {data: 'escola', name: 'edu_escola.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAlocacoes;
}


// Função de execução
function runModalAdicionarAlocacoes(idServidor)
{
    //Carregando as grids de alocações
    if(tableAlocacoes) {
        loadTableAlocacoes(idServidor).ajax.url(laroute.route('servidor.gridAlocacao', {'id' :idServidor })).load();
    } else {
        loadTableAlocacoes(idServidor);
    }

    // Carregando os campos selects
    escolas("");

    // Exibindo o modal
    $('#modal-adicionar-alocacoes').modal({'show' : true});
}

// Id do alocacao
var idAlocacao;


//Evento do click no botão adicionar período
$(document).on('click', '#addAlocacao', function (event) {

    //Recuperando os valores dos campos do fomulário
    var escola = $('#escola').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!escola) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'escola_id' : escola,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.storeAlocacao'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Alocação(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAlocacoes.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposAlocacao();
    });
});

//Evento de remover o telefone
$(document).on('click', '#deleteAlocacao', function () {

    var idAlocacao = tableAlocacoes.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idAlocacao' : idAlocacao
    };

    //Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.removerAlocacao', {'id' : idAlocacao}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Alocação removido com sucesso!", "Click no botão abaixo!", "success");
        tableAlocacoes.ajax.reload();
        table.ajax.reload();
    });
});

//Limpar os campos do formulário
function limparCamposAlocacao()
{
    escolas("");
}



