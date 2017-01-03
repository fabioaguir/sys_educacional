
// Carregando a table
var tableProcedimento;
function loadTableProcedimento (idProcedimentoAvaliacao) {
    // Carregaando a grid
    tableProcedimento = $('#procedimentos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('procedimentoAvaliacao.procedimento.grid', {'id' : idProcedimentoAvaliacao }),
        columns: [
            {data: 'periodo', name: 'periodos.nome'},
            {data: 'forma_avaliacao', name: 'formas_avaliacoes.nome'},
            {data: 'boletim', name: 'boletim'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableProcedimento;
}

// Função de execução
function runModalProcedimentos(idProcedimentoAvaliacao)
{
    //Carregando as grids de situações
    if(tableProcedimento) {
        loadTableProcedimento(idProcedimentoAvaliacao).ajax.url(laroute.route('procedimentoAvaliacao.procedimento.grid', {'id' :idProcedimentoAvaliacao })).load();
    } else {
        loadTableProcedimento(idProcedimentoAvaliacao);
    }

    // Exibindo o modal
    $('#modal-procedimentos').modal({'show' : true});
}


















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


