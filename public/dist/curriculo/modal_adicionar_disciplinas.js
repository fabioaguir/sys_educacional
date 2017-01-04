// Carregando a table
var tableCurriculoSerie;
function loadTableCurriculoSerie (idCurriculo) {
    // Carregaando a grid
    tableCurriculoSerie = $('#serie-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('curriculo.gridSerie', {'id' :idCurriculo }),
        columns: [
            {data: 'nome', name: 'series.nome', orderable: false}
        ]
    });

    return tableCurriculoSerie;
}

// Carregando a table
var tableAdicionarDisciplina;
function loadTableAdicionarDisciplina (curriculoSerieId) {
    // Carregaando a grid
    tableAdicionarDisciplina = $('#disciplina-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('curriculo.gridAdicionarDisciplina', {'idCurriculoSerie' : curriculoSerieId }),
        columns: [
            {data: 'codigo', name: 'disciplinas.codigo', orderable: false},
            {data: 'nome', name: 'disciplinas.nome'},
            {data: 'periodo', name: 'curriculos_series_disciplinas.periodo', orderable: false},
            {data: 'e_obrigatoria', name: 'e_obrigatoria', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAdicionarDisciplina;
}

// Desabilitando os campos de inclusão
function disabledFields() {
    $('#select-disciplinas').prop('disabled', true);
    $('#addDisciplina').prop('disabled', true);
    $('#periodo').prop('disabled', true);
    $('#obrigatorio').prop('disabled', true);
}

// Habilitando os campos de inclusão
function enableFields() {
    $('#select-disciplinas').prop('disabled', false);
    $('#addDisciplina').prop('disabled', false);
    $('#periodo').prop('disabled', false);
    $('#obrigatorio').prop('disabled', false);
}

// Limpando os campos de inclusão
function clearFields() {
    $('#select-disciplinas').val(null).trigger("change");
    $('#periodo').val("");
    $('#obrigatorio option').attr('selected', false);
}

// Função de execução
function runModalAdicionarDisciplinas(idCurriculo)
{
    // Zerando a grid de disciplinas
    loadTableAdicionarDisciplina(0).ajax.url(laroute.route('curriculo.gridAdicionarDisciplina', {'idCurriculoSerie' : 0 })).load();

    //Carregando as grids de situações
    if(tableCurriculoSerie) {
        loadTableCurriculoSerie(idCurriculo).ajax.url(laroute.route('curriculo.gridSerie', {'id' :idCurriculo })).load();
    } else {
        loadTableCurriculoSerie(idCurriculo);
    }

    // Desabilitando os campos de inclusão
    disabledFields();

    // Exibindo o modal
    $('#modal-adicionar-disciplinas').modal({'show' : true});
}

// Id do pivot do curriculo e série
var curriculoSerieId, serieId;

// evento para abrir a grid de disciplina
$(document).on("click", "#serie-grid tbody tr", function (event) {
    if (tableCurriculoSerie.rows().data().length > 0  && $(event.target).is("td")) {
        $(this).parent().find("tr td").removeClass('row_selected');
        $(this).find("td").addClass("row_selected");

        //Recuperando o id da turma selecionada e o index da linha selecionada
        curriculoSerieId = tableCurriculoSerie.row($(this).index()).data().curriculoSerieId;
        serieId = tableCurriculoSerie.row($(this).index()).data().id;

        // habilitando os campos de inclusão
        enableFields();

        //Carregando as grids de situações
        if(tableAdicionarDisciplina) {
            loadTableAdicionarDisciplina(curriculoSerieId).ajax.url(laroute.route('curriculo.gridAdicionarDisciplina', {'idCurriculoSerie' :curriculoSerieId })).load();
        } else {
            loadTableAdicionarDisciplina(curriculoSerieId);
        }
    }
});

//consulta via select2
$("#select-disciplinas").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    ajax: {
        type: 'POST',
        url: laroute.route('curriculo.disciplina.select2'),
        dataType: 'json',
        delay: 250,
        crossDomain: true,
        data: function (params) {
            return {
                'search': params.term,
                'page': params.page || 1,
                'idCurriculoSerie':  curriculoSerieId
            };
        },
        processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;
            
            return {
                results: data.data,
                pagination: {
                    more: data.more
                }
            };
        }
    }
});

//Evento do click no botão adicionar disciplina
$(document).on('click', '#addDisciplina', function (event) {
    // Recuperando o array do select2 e valores do formulário
    var array = $('#select-disciplinas').select2('data');
    var periodo = $('#periodo').val();
    var e_obrigatoria = $('#obrigatorio').val();

    // Verificando se alguma disciplina foi selecionada
    if (!array.length > 0) {
        swal("Oops...", "Você deve selecionar uma disciplina!", "error");
        return false;
    }

    // Array de ids
    var arrayId = [];

    // Percorrendo o array de dados
    for (var i = 0; i < array.length; i++) {
        arrayId[i] = array[i].id
    }

    //Setando o o json para envio
    var dados = {
        'idCurriculo' : idCurriculo,
        'idDisciplinas' : arrayId,
        'idSerie' : serieId,
        'periodo' : periodo ? periodo : 0,
        'e_obrigatoria' : e_obrigatoria
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('curriculo.adicionarDisciplina'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        clearFields();
        swal("Disciplina(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAdicionarDisciplina.ajax.reload();
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
        clearFields();
        swal("Disciplina removida com sucesso!", "Click no botão abaixo!", "success");
        tableAdicionarDisciplina.ajax.reload();
        table.ajax.reload();
    });
});


