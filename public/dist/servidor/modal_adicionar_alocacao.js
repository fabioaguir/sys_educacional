// Carregando a table
var tableAlocacoes, cargaHorariaDisponivel, cargaHorariaUtilizada;
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
            {data: 'carga_horaria', name: 'edu_alocacoes.carga_horaria'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAlocacoes;
}


// Função de execução
function runModalAdicionarAlocacoes(idServidor, cargaHoraria)
{
    //Carregando as grids de alocações
    if(tableAlocacoes) {
        loadTableAlocacoes(idServidor).ajax.url(laroute.route('servidor.gridAlocacao', {'id' :idServidor })).load();
    } else {
        loadTableAlocacoes(idServidor);
    }

    // Preenchendo as cargas horária nos campos bloquados
    $('#carga-horaria-total').val(cargaHoraria);
    getCargaHorariaDisponivel();


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
    var ch     = $('#carga-horaria').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!escola && !ch) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if ( ch <= "0" ) {
        swal("Oops...", "A quantidade de horas deve ser maior que 0", "error");
        return false;
    }

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (ch > cargaHorariaDisponivel) {
        swal("Oops...", "Quantidade de horas informada está superior a quantidade de horas disponível", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'escola_id' : escola,
        'servidor_id' : idServidor,
        'carga_horaria' : ch
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
        getCargaHorariaDisponivel();
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

        getCargaHorariaDisponivel();
    });
});

// Pega a carga horária disponível e utilizada
function getCargaHorariaDisponivel() {

    //Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getCargaHorariaDisponivel'),
        data: {id: idServidor},
        datatype: 'json'
    }).done(function (retorno) {

        console.log('ssss');

        cargaHorariaUtilizada  = retorno['carga_horaria_utilizada'] != null ? retorno['carga_horaria_utilizada'] : 0;
        cargaHorariaDisponivel = cargaHoraria - cargaHorariaUtilizada;

        $('#carga-horaria-disp').val(cargaHorariaDisponivel);

    });

}


//Limpar os campos do formulário
function limparCamposAlocacao()
{
    escolas("");
}



