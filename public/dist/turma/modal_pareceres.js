// Carregando a table
var tableParecer;
function loadTableParecer (idTurma) {
    // Carregaando a grid
    tableParecer = $('#pareceres-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turma.parecer.grid', {'idTurma' : idTurma }),
        columns: [
            {data: 'codigo', name: 'edu_pareceres.codigo'},
            {data: 'nome', name: 'edu_pareceres.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableParecer;
}

// Função de execução
function runModalParecer(idTurma)
{
    //Carregando as grids de situações
    if(tableParecer) {
        loadTableParecer(idTurma).ajax.url(laroute.route('turma.parecer.grid', {'idTurma' :idTurma })).load();
    } else {
        loadTableParecer(idTurma);
    }
    
    // Exibindo o modal
    $('#modal-pareceres').modal({'show' : true});
}


//consulta via select2
$("#select-pareceres").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    width: "100%",
    ajax: {
        type: 'POST',
        url: laroute.route('turma.parecer.select2'),
        dataType: 'json',
        delay: 250,
        crossDomain: true,
        data: function (params) {
            return {
                'search': params.term,
                'page': params.page || 1,
                'idTurma':  idTurma
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

// Limpando os campos de inclusão
function clearFieldsPareceres() {
    $('#select-pareceres').val(null).trigger("change");
}


//Evento do click no botão adicionar parecer
$(document).on('click', '#addParecer', function (event) {
    // Recuperando o array do select2 e valores do formulário
    var array = $('#select-pareceres').select2('data');
   
    // Verificando se alguma disciplina foi selecionada
    if (!array.length > 0) {
        swal("Oops...", "Você deve selecionar uma parecer!", "error");
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
        'idTurma' : idTurma,
        'idPareceres' : arrayId
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.parecer.adicionarParecer'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        clearFieldsPareceres();
        swal("Parecer(es) adicionado(s) com sucesso!", "Click no botão abaixo!", "success");
        tableParecer.ajax.reload();
        table.ajax.reload();
    });
});

//Evento de remover a parecer
$(document).on('click', '#destroyParecer', function () {
    var idTurmaParecer = tableParecer.row($(this).parents('tr').index()).data().idTurmaParecer;

    //Setando o o json para envio
    var dados = {
        'idTurmaParecer' : idTurmaParecer
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.parecer.removerParecer'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        clearFieldsPareceres();
        swal("Parecer removida com sucesso!", "Click no botão abaixo!", "success");
        tableParecer.ajax.reload();
        table.ajax.reload();
    });
});


