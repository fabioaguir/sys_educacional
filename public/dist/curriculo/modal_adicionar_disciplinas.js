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
            {data: 'nome', name: 'series.nome'}
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
            {data: 'codigo', name: 'disciplinas.codigo'},
            {data: 'nome', name: 'disciplinas.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAdicionarDisciplina;
}

// Função de execução
function runModalAdicionarDisciplinas(idCurriculo)
{
    // Zerando a grid de disciplinas
    loadTableAdicionarDisciplina(curriculoSerieId).ajax.url(laroute.route('curriculo.gridAdicionarDisciplina', {'idCurriculoSerie' : 0 })).load();

    //Carregando as grids de situações
    if(tableCurriculoSerie) {
        loadTableCurriculoSerie(idCurriculo).ajax.url(laroute.route('curriculo.gridSerie', {'id' :idCurriculo })).load();
    } else {
        loadTableCurriculoSerie(idCurriculo);
    }

    // Desabilitando a o select2 e o botão de adicionar
    $('#select-disciplinas').prop('disabled', true);
    $('#addDisciplina').prop('disabled', true);

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

        // habilitando o select2 e o botão de adicionar
        $('#select-disciplinas').prop('disabled', false);
        $('#addDisciplina').prop('disabled', false);

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
    // Recuperando o array do select2
    var array = $('#select-disciplinas').select2('data');

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
        'idSerie' : serieId
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('curriculo.adicionarDisciplina'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        $('#select-disciplinas').val(null).trigger("change");
        swal("Disciplina(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAdicionarDisciplina.ajax.reload();
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
    });
});


