/**
 * Created by fabio_000 on 18/09/2017.
 */
// carregando todos os campos preenchidos
function runRelatorioFixaDoAluno()
{

    //Limpando os campos
    $('#calendario_id option').find('option').prop('selected', false);
    $('#aluno_id option').remove();
    $('#turma_id option').remove();

    // carregando os loadfields
    calendarios("");

    // Abrindo o modal
    $("#modal-report-fixa-do-aluno").modal({show : true});

}

// Gerar o relatório
$('#btnFixaDoAluno').click(function() {
    // Recuperando o id do relatório selecionado
    var calendarioId   = $('#calendario_id').val();
    var turmaId = $('#turma_id').val();
    var aluno    = $('#aluno_id').val();

    // Validando as entradas
    if(!calendarioId || !turmaId || !aluno) {
        swal('Todos os campos do filtros são obrigatórios!', 'Click no botão abaixo', 'error');
        return false;
    }

    // Executando o relatório e abrindo em outra aba
    window.open("/index.php/relatorios/alunos/fixa/"+ aluno, '_blank');
});