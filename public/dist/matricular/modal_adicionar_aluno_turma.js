// Carregando a table
var tableAlunoTurmas;
function loadTableAlunoTurmas (idTurma) {
    // Carregaando a grid
    tableAlunoTurmas = $('#aluno-turmas-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('matricular.gridAlunoTurma', {'id' :idTurma }),
        columns: [
            {data: 'nome', name: 'cgm.nome'},
            {data: 'turmaAnterior', name: 'turmaAnterior', orderable: false, searchable: false},
            {data: 'data_matricula', name: 'alunos_turmas.data_matricula'},
            {data: 'data_saida', name: 'alunos_turmas.data_saida'},
            {data: 'matricula', name: 'alunos_turmas.matricula'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableAlunoTurmas;
}


// Função de execução
function gridAlunosTurmas(idTurma)
{
    //Carregando as grids de alocações
    if(tableAlunoTurmas) {
        loadTableAlunoTurmas(idTurma).ajax.url(laroute.route('matricular.gridAlunoTurma', {'id' :idTurma })).load();
    } else {
        loadTableAlunoTurmas(idTurma);
    }
}

// Id do alocacao
var idAlunoTurma


//Evento do click no botão adicionar período
$(document).on('click', '#addAlunoTurma', function (event) {

    //Recuperando os valores dos campos do fomulário
    var turma = $('#turma').val();
    var data = $('#data_matricula').val();

    var dados = [];

    $( "#destination option" ).each(function() {
        dados.push({'alunos_id' : $(this).val(), 'turmas_id' : turma, 'data_matricula' : data});
    });

    console.log(dados);

    // Verificando se os campos de preenchimento obrigatório foram preenchidos
    if (!turma || !data || dados.length <= 0) {
        swal("Oops...", "Há campos obrigatórios que não foram preenchidos!", "error");
        return false;
    }

    //Setando o o json para envio
    var dados = {
        'turma_id' : turma,
        'dados' : dados
    };

    // Requisição Ajax
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('matricular.store'),
        data: dados,
        datatype: 'json'
    }).done(function (json) {

        if(json['success']) {
            swal("Aluno(s) matriculado(s) com sucesso!", "Click no botão abaixo!", "success");
            tableAlunoTurmas.ajax.reload();

            //Limpar os campos do formulário
            limparCamposAlunosTurmas();
        } else {
            swal("Oops...", json['resposta'], "error");
        }
    });
});

//Evento para pegar o dia da semana da data de feriado informado
$(document).on('change', '#turma', function () {

    // Recuperando o valor da data inicial
    var turma       = $('#turma').val();
    var nomeTurma   = $('#turma :selected').text();

    // Preenchendo o campo nome da turma no combobox ne matrícula de aluno
    if(turma) {
        $('#nome-turma').text(nomeTurma);
    } else {
        $('#nome-turma').text("");
    }

    //Setando o o json para envio
    var dados = {
        'turma' : turma
    };

    // Validando se a turma foi selecionada
    if(turma) {

        // Requisição Ajax
        jQuery.ajax({
            type: 'POST',
            url: laroute.route('matricular.getDadosTurma'),
            data: dados,
            datatype: 'json'
        }).done(function (retorno) {

            $('#calendario').val(retorno['dados']['calendario_nome']);
            $('#curso').val(retorno['dados']['curso']);
            $('#serie').val(retorno['dados']['serie']);
            $('#turno').val(retorno['dados']['turno']);
            $('#vagas').val(retorno['dados']['vagas']);
            $('#alunos_matriculados').val(retorno['qtdAlunos']);
            $('#vagas_disponiveis').val(retorno['vRestantes']);

            var option = '';

            for (var i = 0; i < retorno['alunoNotTurma'].length; i++) {
                option += '<option value="' + retorno['alunoNotTurma'][i]['id'] + '">' + retorno['alunoNotTurma'][i]['nome'] + '</option>';
            }

            $('#source option').remove();
            $('#source').append(option);

            // Carregando a grid de aluno conforme a turma selecionada
            gridAlunosTurmas(turma);

        });
    } else {
        // Zerando a grid de alunos
        gridAlunosTurmas("0");
    }

});

//Limpar os campos do formulário
function limparCamposAlunosTurmas()
{
    turmas("");
    $('.campo').val("");
    $('#source option').remove();
    $('#destination option').remove();

}



