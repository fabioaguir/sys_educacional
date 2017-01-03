// Carregando a table
var tableAtividade;
function loadTableAtividade (idTurmaComplementar) {
    // Carregaando a grid
    tableAtividade = $('#atividades-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turmaComplementar.atividade.grid', {'idTurmaComplementar' : idTurmaComplementar }),
        columns: [
            {data: 'codigo', name: 'atividades_complementares.codigo'},
            {data: 'nome', name: 'atividades_complementares.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAtividade;
}

// Limpando os campos de inclusão
function clearFields() {
    $('#select-atividades').val(null).trigger("change");
}

// Função de execução
function runModalAtividades(idTurmaComplementar)
{
    //Carregando as grids de situações
    if(tableAtividade) {
        loadTableAtividade(idTurmaComplementar).ajax.url(laroute.route('turmaComplementar.atividade.grid', {'idTurmaComplementar' :idTurmaComplementar })).load();
    } else {
        loadTableAtividade(idTurmaComplementar);
    }
    
    // Exibindo o modal
    $('#modal-atividades').modal({'show' : true});
}


//consulta via select2
$("#select-atividades").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    width: "100%",
    ajax: {
        type: 'POST',
        url: laroute.route('turmaComplementar.atividade.select2'),
        dataType: 'json',
        delay: 250,
        crossDomain: true,
        data: function (params) {
            return {
                'search': params.term,
                'page': params.page || 1,
                'idTurmaComplementar':  idTurmaComplementar
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

//Evento do click no botão adicionar atividade
$(document).on('click', '#addAtividade', function (event) {
    // Recuperando o array do select2 e valores do formulário
    var array = $('#select-atividades').select2('data');
   
    // Verificando se alguma disciplina foi selecionada
    if (!array.length > 0) {
        swal("Oops...", "Você deve selecionar uma atividade!", "error");
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
        'idTurmaComplementar' : idTurmaComplementar,
        'idAtividades' : arrayId
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turmaComplementar.atividade.adicionarAtividade'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        clearFields();
        swal("Atividade(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        tableAtividade.ajax.reload();
        table.ajax.reload();
    });
});

//Evento de remover a atividade
$(document).on('click', '#destroyAtividade', function () {
    var idTurmaAtividade = tableAtividade.row($(this).parents('tr').index()).data().idTurmaAtividade;

    //Setando o o json para envio
    var dados = {
        'idTurmaAtividade' : idTurmaAtividade
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turmaComplementar.atividade.removerAtividade'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        clearFields();
        swal("Atividade removida com sucesso!", "Click no botão abaixo!", "success");
        tableAtividade.ajax.reload();
        table.ajax.reload();
    });
});


