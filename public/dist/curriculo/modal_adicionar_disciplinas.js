// Carregando a table
var tableAdicionarDisciplina;
function loadTableAdicionarDisciplina (idCurriculo) {
    // Carregaando a grid
    tableAdicionarDisciplina = $('#disciplina-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('curriculo.gridAdicionarDisciplina', {'id' :idCurriculo }),
        columns: [
            {data: 'codigo', name: 'disciplinas.codigo'},
            {data: 'nome', name: 'disciplinas.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
}

// Função de execução
function runModalAdicionarDisciplinas(idCurriculo)
{
    //Carregando as grids de situações
    if(tableAdicionarDisciplina) {
        loadTableAdicionarDisciplina(idCurriculo).ajax.url(laroute.route('gridAdicionarDisciplina', {'id' :idCurriculo })).load();
    } else {
        loadTableAdicionarDisciplina(idCurriculo);
    }

    // Exibindo o modal
    $('#modal-adicionar-disciplinas').modal({'show' : true});
}

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
                'idCurriculo':  idCurriculo
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
        'idDisciplinas' : arrayId
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
    idCurriculo  = tableAdicionarDisciplina.row($(this).parents('tr').index()).data().idCurriculo;
    idDisciplina = tableAdicionarDisciplina.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idCurriculo' : idCurriculo,
        'idDisciplina' : idDisciplina
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


