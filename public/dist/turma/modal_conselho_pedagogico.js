// Carregando a table
var tableConcelho;
function loadTableConcelho (idTurma) {
    // Carregaando a grid
    tableConcelho = $('#concelho-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turma.concelho.grid', {'id' :idTurma }),
        columns: [
            {data: 'periodo', name: 'edu_periodos.nome'},
            {data: 'dificuldades', name: 'edu_concelho_pedagogico.dificuldades'},
            {data: 'orientacoes', name: 'edu_concelho_pedagogico.orientacoes'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableConcelho;
}


// Função de execução
function runModalAdicionarConcelho(idTurma)
{
    //Carregando as grids de situações
    if(tableConcelho) {
        loadTableConcelho(idTurma).ajax.url(laroute.route('turma.concelho.grid', {'id' :idTurma })).load();
    } else {
        loadTableConcelho(idTurma);
    }

    // Carregando os campos selects
    periodos("", idTurma);

    // Desabilitando o botão de editar
    $('#edtConcelho').prop('disabled', true);
    $('#edtConcelho').hide();

    // Exibindo o modal
    $('#modal-adicionar-concelho').modal({'show' : true});
}

// Id do telefone
var idConcelho;


//Evento do click no botão adicionar período
$(document).on('click', '#addConcelho', function (event) {

    //Recuperando os valores dos campos do fomulário
    var periodo      = $('#periodo').val();
    var dificuldade  = $('#dificuldades').val();
    var orientacao   = $('#orientacoes').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!periodo) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'periodo_id' : periodo,
        'dificuldades' : dificuldade,
        'orientacoes' : orientacao,
        'turma_id' : idTurma
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.concelho.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Concelho pedagógico adicionado com sucesso!", "Click no botão abaixo!", "success");
        tableConcelho.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposConcelho();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtConcelho', function (event) {

    //Recuperando os valores dos campos do fomulário
    var periodo      = $('#periodo').val();
    var dificuldade  = $('#dificuldades').val();
    var orientacao   = $('#orientacoes').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!periodo) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'periodo_id' : periodo,
        'dificuldades' : dificuldade,
        'orientacoes' : orientacao,
        'turma_id' : idTurma
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.concelho.update', {'id' : idConcelho}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Concelho pedagógico editado com sucesso!", "Click no botão abaixo!", "success");
        tableConcelho.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposConcelho();

        // Desabilitando o botão de editar
        $('#edtConcelho').prop('disabled', true);
        $('#edtConcelho').hide();
        $('#addConcelho').show();

    });
});

//Evento de remover o telefone
$(document).on('click', '#deleteConcelho', function () {

    var idConcelho = tableConcelho.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idConcelho' : idConcelho
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.concelho.remover', {'id' : idConcelho}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Concelho pedagógico removido com sucesso!", "Click no botão abaixo!", "success");
        tableConcelho.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar o evento letivos
$(document).on("click", "#editarConcelho", function () {
    //Recuperando o id da concelho
    idConcelho = tableConcelho.row($(this).parents('tr')).data().id;

    // Recuperando os dados do evento
    var periodo         = tableConcelho.row($(this).parents('tr')).data().periodo_id;
    var dificuldades    = tableConcelho.row($(this).parents('tr')).data().dificuldades;
    var orientacoes     = tableConcelho.row($(this).parents('tr')).data().orientacoes;

    // prenchendo o os campos
    periodos(periodo, idTurma);
    $('#dificuldades').val(dificuldades);
    $('#orientacoes').val(orientacoes);

    // Desabilitando o botão de editar
    $('#edtConcelho').prop('disabled', false);
    $('#edtConcelho').show();
    $('#addConcelho').hide();

});

//Limpar os campos do formulário
function limparCamposConcelho()
{
    periodos("", idTurma);
    $('#dificuldades').val("");
    $('#orientacoes').val("");
}



