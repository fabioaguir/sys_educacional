/**
 * Created by Fabio Aguiar on 16/01/2017.
 */


//Global idCgm, idServidor
var idCgm, idServidor;

// Evento para abrir o modal de telefones
$(document).on("click", "#btnModalAdicionarTelefone", function () {
    // Recuperando o id do cgm
    idCgm = table.row($(this).parents('tr')).data().cgm_id;

    // Recuperando o nome e matrícula
    var nome = table.row($(this).parents('tr')).data().nome;
    var matricula   = table.row($(this).parents('tr')).data().matricula;

    // prenchendo o titulo do nome e matrícula do servidor
    $('#sNome').text(nome);
    $('#sMatricula').text(matricula);

    // Executando o modal
    runModalAdicionarTelefones(idCgm);
});

// Evento para abrir o modal de relações de trabalho
$(document).on("click", "#btnModalAdicionarRelacao", function () {
    // Recuperando o id da relacao
    idServidor = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e matrícula
    var nome = table.row($(this).parents('tr')).data().nome;
    var matricula   = table.row($(this).parents('tr')).data().matricula;

    // prenchendo o titulo do nome e matrícula do servidor
    $('.sNome').text(nome);
    $('.sMatricula').text(matricula);

    // Executando o modal
    runModalAdicionarRelacoes(idServidor);
});

// Evento para abrir o modal de formações
$(document).on("click", "#btnModalAdicionarFormacao", function () {
    // Recuperando o id da formação
    idServidor = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e matrícula
    var nome = table.row($(this).parents('tr')).data().nome;
    var matricula   = table.row($(this).parents('tr')).data().matricula;

    // prenchendo o titulo do nome e matrícula do servidor
    $('.sNome').text(nome);
    $('.sMatricula').text(matricula);

    // Executando o modal
    runModalAdicionarFormacoes(idServidor);
});

// Evento para abrir o modal de formações
$(document).on("click", "#btnModalAdicionarAtividade", function () {
    // Recuperando o id da formação
    idServidor = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e matrícula
    var nome = table.row($(this).parents('tr')).data().nome;
    var matricula   = table.row($(this).parents('tr')).data().matricula;

    // prenchendo o titulo do nome e matrícula do servidor
    $('.sNome').text(nome);
    $('.sMatricula').text(matricula);

    // Executando o modal
    runModalAdicionarAtividades(idServidor);
});

// Evento para abrir o modal de alocações
$(document).on("click", "#btnModalAdicionarAlocacao", function () {
    // Recuperando o id da alocação
    idServidor = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e matrícula
    var nome = table.row($(this).parents('tr')).data().nome;
    var matricula   = table.row($(this).parents('tr')).data().matricula;

    // prenchendo o titulo do nome e matrícula do servidor
    $('.sNome').text(nome);
    $('.sMatricula').text(matricula);

    // Executando o modal
    runModalAdicionarAlocacoes(idServidor);
});

// Evento para abrir o modal de disponibilidades
$(document).on("click", "#btnModalAdicionarDisponibilidade", function () {
    // Recuperando o id do servidor
    idServidor = table.row($(this).parents('tr')).data().id;

    // Recuperando o nome e matrícula
    var nome = table.row($(this).parents('tr')).data().nome;
    var matricula   = table.row($(this).parents('tr')).data().matricula;

    // prenchendo o titulo do nome e matrícula do servidor
    $('.sNome').text(nome);
    $('.sMatricula').text(matricula);

    // Executando o modal
    runModalAdicionarDisponibilidades(idServidor);
});
