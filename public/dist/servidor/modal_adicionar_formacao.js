// Carregando a table
var tableFormacoes;
function loadTableFormacoes (idServidor) {
    // Carregaando a grid
    tableFormacoes = $('#formacoes-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('servidor.gridFormacao', {'id' :idServidor }),
        columns: [
            {data: 'curso', name: 'cursos_formacao.nome'},
            {data: 'instituicao', name: 'instituicoes_formacao.nome'},
            {data: 'licenciatura', name: 'licenciatura.nome'},
            {data: 'situacao', name: 'situacao_formacao.nome'},
            {data: 'ano_conclusao', name: 'formacoes.ano_conclusao'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableFormacoes;
}


// Função de execução
function runModalAdicionarFormacoes(idServidor)
{
    //Carregando as grids de situações
    if(tableFormacoes) {
        loadTableFormacoes(idServidor).ajax.url(laroute.route('servidor.gridFormacao', {'id' :idServidor })).load();
    } else {
        loadTableFormacoes(idServidor);
    }

    // Desabilitando o botão de editar
    $('#edtFormacao').prop('disabled', true);
    $('#edtFormacao').hide();

    // Exibindo o modal
    $('#modal-adicionar-formacoes').modal({'show' : true});
}

// Id do telefone
var idFormacao;


//Evento do click no botão adicionar formação
$(document).on('click', '#addFormacao', function (event) {

    //Recuperando os valores dos campos do fomulário
    var curso           = $('#curso').val();
    var instituicao     = $('#instituicao').val();
    var situacao        = $('#situacao').val();
    var licenciatura    = $('#licenciatura').val();
    var ano             = $('#ano').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!curso || !instituicao || !situacao || !licenciatura || !ano) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'ano_conclusao' : ano,
        'cursos_formacao_id' : curso,
        'situacao_formacao_id' : situacao,
        'instituicoes_formacao_id' : instituicao,
        'licenciatura_id' : licenciatura,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.storeFormacao'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Formação de trabalho(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableFormacoes.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposFormacao();
    });
});

//Evento do click no botão editar evento
$(document).on('click', '#edtFormacao', function (event) {

    //Recuperando os valores dos campos do fomulário
    var curso           = $('#curso').val();
    var instituicao     = $('#instituicao').val();
    var situacao        = $('#situacao').val();
    var licenciatura    = $('#licenciatura').val();
    var ano             = $('#ano').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!curso || !instituicao || !situacao || !licenciatura || !ano) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'ano_conclusao' : ano,
        'cursos_formacao_id' : curso,
        'situacao_formacao_id' : situacao,
        'instituicoes_formacao_id' : instituicao,
        'licenciatura_id' : licenciatura,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.updateFormacao', {'id' : idFormacao}),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Formação de trabalho(s) editado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableFormacoes.ajax.reload();
        table.ajax.reload();

        //Limpar os campos do formulário
        limparCamposFormacao();

        // Desabilitando o botão de editar
        $('#edtFormacao').prop('disabled', true);
        $('#edtFormacao').hide();
        $('#addFormacao').show();

    });
});

//Evento de remover a formação
$(document).on('click', '#deleteFormacao', function () {

    var idFomacao = tableFormacoes.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idFomacao' : idFomacao
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.removerFormacao', {'id' : idFomacao}),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Formação de trabalho removido com sucesso!", "Click no botão abaixo!", "success");
        tableFormacoes.ajax.reload();
        table.ajax.reload();
    });
});


// Evento para editar a formação
$(document).on("click", "#editarFormacao", function () {
    //Recuperando o id da relacao
    idFormacao = tableFormacoes.row($(this).parents('tr')).data().id;

    // Recuperando os dados da formação
    var curso           = tableFormacoes.row($(this).parents('tr')).data().curso_id;
    var instituicao     = tableFormacoes.row($(this).parents('tr')).data().instituicao_id;
    var situacao        = tableFormacoes.row($(this).parents('tr')).data().situacao_id;
    var licenciatura    = tableFormacoes.row($(this).parents('tr')).data().licenciatura_id;
    var ano             = tableFormacoes.row($(this).parents('tr')).data().ano_conclusao;

    // prenchendo o os campos de formação
    cursos(curso);
    instituicoes(instituicao);
    situacoes(situacao);
    licenciaturas(licenciatura);
    $('#ano').val(ano);

    // Desabilitando o botão de editar
    $('#edtFormacao').prop('disabled', false);
    $('#edtFormacao').show();
    $('#addFormacao').hide();

});


//Adicionar pos-graduação e outros cursos
$(document).on('click', '#edtOutrosCursos', function () {

    var arrayPos    = $('#select-posgraduacao').select2('data');
    var arrayOutros = $('#select-outroscursos').select2('data');

    // Verificando se alguma opção selecionada
    if (!arrayPos.length > 0 || !arrayOutros.length > 0) {
        swal("Oops...", "Você deve selecionar uma pos-graduação ou outros cursos !", "error");
        return false;
    }

    // Array de ids
    var arrayIdPos = [];
    var arrayIdOutros = [];

    // Percorrendo o array de dados
    for (var i = 0; i < arrayPos.length; i++) {
        arrayIdPos[i] = arrayPos[i].id
    }
    for (var j = 0; j < arrayOutros.length; i++) {
        arrayIdOutros[j] = arrayOutros[j].id
    }

    //Setando o o json para envio
    var dados = {
        'idPos' : arrayIdPos,
        'idOutros' : arrayIdOutros,
        'servidor_id' : idServidor
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.edtOutrosCursos'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        swal("Formação de trabalho removido com sucesso!", "Click no botão abaixo!", "success");
        tableFormacoes.ajax.reload();
        table.ajax.reload();
    });
});

//Limpar os campos do formulário
function limparCamposFormacao()
{
    cursos("");
    instituicoes("");
    situacoes("");
    licenciaturas("");
    $('#ano').val("");
}



