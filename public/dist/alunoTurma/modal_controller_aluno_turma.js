/**
 * Created by Fabio Aguiar on 16/01/2017.
 */

//Global idAluno
var idAluno;

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
