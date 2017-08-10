/**
 * Created by Fabio Aguiar on 16/01/2017.
 */


// Evento para abrir o modal de matrícula
$(document).on("click", "#btnModalAdicionarAlunoTurma", function () {
    // Recuperando o id do calendário
    idAluno = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e o código
    var nome = table.row($(this).parents('tr')).data().nome;
    var codigo   = table.row($(this).parents('tr')).data().codigo;

    // prenchendo o titulo do nome do aluno
    $('#aNome').text(nome);
    $('#aCodigo').text(codigo);

    // Executando o modal
    runModalAdicionarAlunosTurmas(idAluno);
});


// Evento para abrir o modal de matrícula
$(document).on("click", "#btnModalHistoricoAluno", function () {
    // Recuperando o id do aluno
    idAluno = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e o código
    var nome = table.row($(this).parents('tr')).data().nome;
    var codigo   = table.row($(this).parents('tr')).data().codigo;

    // prenchendo o titulo do nome do aluno
    $('#hNome').text(nome);
    $('#hCodigo').text(codigo);

    // Executando o modal
    runModalHistoricoAluno(idAluno);
});

// Evento para abrir o modal de matrícula
$(document).on("click", "#btnModalMudarTurma", function () {
    // Recuperando o id do aluno
    idMatricula = table.row($(this).parents('tr')).data().matricula;
    idSerie = table.row($(this).parents('tr')).data().serie_id;
    idEscola = table.row($(this).parents('tr')).data().escola_id;
    idTurma  = table.row($(this).parents('tr')).data().turma_id;

    // Recuperando o nome e o código
    var nome = table.row($(this).parents('tr')).data().nome;
    var codigo   = table.row($(this).parents('tr')).data().codigo;

    // prenchendo o titulo do nome do aluno
    $('#tNome').text(nome);
    $('#tCodigo').text(codigo);

    // Executando o modal
    runModalMudarTurma(idMatricula, idSerie, idEscola, idTurma);
});