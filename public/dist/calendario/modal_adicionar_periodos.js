// Carregando a table
var tablePeriodos;
function loadTablePeriodos (idCalendario) {
    // Carregaando a grid
    tablePeriodos = $('#periodos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('calendario.gridPeriodo', {'id' :idCalendario }),
        columns: [
            {data: 'periodo', name: 'periodos.nome'},
            {data: 'data_inicial', name: 'periodos_avaliacao.data_inicial'},
            {data: 'data_final', name: 'periodos_avaliacao.data_final'},
            {data: 'dias_letivos', name: 'periodos_avaliacao.dias_letivos'},
            {data: 'semanas_letivas', name: 'periodos_avaliacao.semanas_letivas'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tablePeriodos;
}


// Função de execução
function runModalAdicionarPeriodos(idCalendario)
{
    //Carregando as grids de situações
    if(tablePeriodos) {
        loadTablePeriodos(idCalendario).ajax.url(laroute.route('calendario.gridPeriodo', {'id' :idCalendario })).load();
    } else {
        loadTablePeriodos(idCalendario);
    }

    // Desabilitando o botão de editar
    $('#edtPeriodo').prop('disabled', true);
    $('#edtPeriodo').hide();

    // Exibindo o modal
    $('#modal-adicionar-periodos').modal({'show' : true});
}

// Id do pivot do curriculo e série
var curriculoSerieId, serieId;


//Evento do click no botão adicionar período
$(document).on('click', '#addPeriodo', function (event) {

    //Recuperando os valores dos campos do fomulário
    var periodo         = $('#periodo').val();
    var dtInicial       = $('#dtInicial').val();
    var dtFinal         = $('#dtFinal').val();
    var diasLetivos     = $('#diasLetivos').val();
    var semanasLetivas  = $('#semanasLetivas').val();
    
    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!periodo || !dtInicial || !dtFinal ) {
        swal("Oops...", "Você deve selecionar um período e informar data inicial e final!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'calendarios_id' : idCalendario,
        'periodos_id' : periodo,
        'data_inicial' : dtInicial,
        'data_final' : dtFinal,
        'dias_letivos' : diasLetivos,
        'semanas_letivas' : semanasLetivas
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.storePeriodo'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        swal("Disciplina(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tablePeriodos.ajax.reload();
        table.ajax.reload();
    });
});

//Evento de remover a disciplina
$(document).on('click', '.removerDisciplina', function () {
    var idCurriculoSerieDisciplina = tableAdicionarDisciplina.row($(this).parents('tr').index()).data().idCurriculoSerieDisciplina;

    //Setando o o json para envio
    var dados = {
        'idCurriculoSerieDisciplina' : idCurriculoSerieDisciplina
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('curriculo.removerDisciplina'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        $('#select-disciplinas').val(null).trigger("change");
        swal("Disciplina removida com sucesso!", "Click no botão abaixo!", "success");
        tableAdicionarDisciplina.ajax.reload();
        table.ajax.reload();
    });
});

//Evento para validar data inicial conforme o período do calendário
$(document).on('change', '#dtInicial', function () {
    
    // Recuperando o valor da data inicial
    var data = $('#dtInicial').val();
    
    // Retorna a reposta da validação da data
    validarDatas(data);

});

//Evento para validar data final conforme o período do calendário
$(document).on('change', '#dtFinal', function () {

    // Recuperando o valor da data inicial
    var data = $('#dtFinal').val();

    // Retorna a reposta da validação da data
    validarDatas(data);

});

// Função para validar se as datas estão dentro do período do calendário
function validarDatas(data) {
    
    //Setando o o json para envio
    var dados = {
        'idCalendario' : idCalendario,
        'data' : data
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.validarDataCalendario'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {

        // Exibi mensagem de falha na validação da data
        if(retorno == 0) {

            // Desabilitando o botão de editar e adicionar
            $('#edtPeriodo').prop('disabled', true);
            $('#addPeriodo').prop('disabled', true);

            swal("Oops...", "A data informada não está dentro do período informado no calendário!", "error");
        } else {
            $('#edtPeriodo').prop('disabled', false);
            $('#addPeriodo').prop('disabled', false);
        }
    });
}

