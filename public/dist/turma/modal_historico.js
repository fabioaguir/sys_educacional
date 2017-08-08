// Carregando a table
var tableHistorico;
function loadTableHistorico (idTurma) {
    // Carregaando a grid
    tableHistorico = $('#historico-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turma.historico.gridAlunos', {'idTurma' : idTurma }),
        columns: [
            {data: 'matricula', name: 'edu_historico.matricula'},
            {data: 'nome', name: 'gen_cgm.nome'},
            {data: 'data_matricula', name: 'edu_historico.data_matricula'},
            {data: 'situacao', name: 'edu_situacao_matricula.nome'}
        ]
    });

    return tableHistorico;
}


// Selecionar as tr da grid
$(document).on('click', '#historico-grid tbody tr', function () {
    // Aplicando o estilo css
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
    } else {
        $(this).addClass("selected");
    }
});


// Evento para quando clicar na tr da table de pacientes
$(document).on('click', '#historico-grid tbody tr', function () {

    // Array que armazenará os ids dos alunos
    var arrayId = [];

    // Varrendo as linhas
    $("#historico-grid tbody tr.selected").each(function (index, value) {

        arrayId[index] = tableHistorico.row($(value).index()).data().id;

    });

    idsAlunos = arrayId;

});

// Função de execução
function runModalHistorico(idTurma, idEscola, idSerie, nomeSerie)
{
    //Carregando as grids de alunos
    if(tableHistorico) {
        loadTableHistorico(idTurma).ajax.url(laroute.route('turma.historico.gridAlunos', {'idTurma' :idTurma })).load();
    } else {
        loadTableHistorico(idTurma);
    }

    series("", idSerie);

    // Exibindo o modal
    $('#modal-historico').modal({'show' : true});
}


//Evento do click para matricular
$(document).on('click', '#matricular', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma  = $('#turma-historico').val();
    var serie  = $('#serie-historico').val();
    var escola = idEscola;
    var alunos = idsAlunos;
    var vagas  = $('#vagas-historico').val();

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!turma || !serie || !alunos) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'alunos' : alunos,
        'serie_id' : serie,
        'turma_id' : turma,
        'escola_id' : escola,
        'vagas' : escola
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('turma.historico.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if (json['success']) {
            swal("Aluno(s) matriculado(s) com sucesso!", "Click no botão abaixo!", "success");
            tableHistorico.ajax.reload();
            table.ajax.reload();
        } else {
            swal(json['mensagem'], "Click no botão abaixo!", "error");
        }

        //Limpar os campos do formulário
        //limparCamposAlunosTurmas();
    });

});