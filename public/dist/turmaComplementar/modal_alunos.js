// Carregando a table
var tableAluno;
function loadTableAluno (idTurmaComplementar) {
    // Carregaando a grid
    tableAluno = $('#alunos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turmaComplementar.aluno.grid', {'idTurmaComplementar' : idTurmaComplementar }),
        columns: [
            {data: 'matricular', name: 'alunos.codigo'},
            {data: 'nome', name: 'cgm.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAluno;
}

// Limpando os campos de inclusão
function clearFields() {
    $('#select-alunos').val(null).trigger("change");
}

// Função de execução
function runModalAluno(idTurmaComplementar)
{
    //Carregando as grids de alunos
    if(tableAluno) {
        loadTableAluno(idTurmaComplementar).ajax.url(laroute.route('turmaComplementar.aluno.grid', {'idTurmaComplementar' :idTurmaComplementar })).load();
    } else {
        loadTableAluno(idTurmaComplementar);
    }
    
    // Exibindo o modal
    $('#modal-alunos').modal({'show' : true});
}

//consulta via select2
$("#select-alunos").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    width: "100%",
    ajax: {
        type: 'POST',
        url: laroute.route('turmaComplementar.aluno.select2'),
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

//Evento do click no botão adicionar aluno
$(document).on('click', '#addAluno', function (event) {
    // Recuperando o array do select2 e valores do formulário
    var array = $('#select-alunos').select2('data');
   
    // Verificando se algum aluno foi selecionada
    if (!array.length > 0) {
        swal("Oops...", "Você deve selecionar um aluno!", "error");
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
        'idAlunos' : arrayId
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turmaComplementar.aluno.adicionarAluno'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {
        clearFields();
        numAlunosMatriculados();

        // Validando a mensagem
        if(json.success) {
            swal("Aluno(s) adicionada(s) com sucesso!", "Click no botão abaixo!", "success");
        } else {
            swal(json.msg, "Click no botão abaixo!", "error");
        }

        tableAluno.ajax.reload();
        table.ajax.reload();
    });
});

//Evento de remover a atividade
$(document).on('click', '#destroyAluno', function () {
    var idAlunoTurmaComplementar = tableAluno.row($(this).parents('tr').index()).data().id;

    //Setando o o json para envio
    var dados = {
        'idAlunoTurmaComplementar' : idAlunoTurmaComplementar
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turmaComplementar.aluno.removerAluno'),
        data: dados,
        datatype: 'json'
    }).done(function (retorno) {
        clearFields();
        numAlunosMatriculados();

        swal("Aluno removida com sucesso!", "Click no botão abaixo!", "success");
        tableAluno.ajax.reload();
        table.ajax.reload();
    });
});

/**
 *
 */
function numAlunosMatriculados()
{
    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turmaComplementar.aluno.findNumAlunosMatriculados', {'idTurmaComplementar' : idTurmaComplementar}),
        datatype: 'json'
    }).done(function (retorno) {
        $('#numVagas').val(retorno.valor);
    });
}