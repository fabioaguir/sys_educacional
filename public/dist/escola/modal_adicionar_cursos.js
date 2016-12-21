// Carregando a table
var tableEscolaCurso;
function loadTableEscolaCurso (idEscola) {
    // Carregaando a grid
    tableEscolaCurso = $('#cursos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('escola.curso.gridCursos', {'id' :idEscola }),
        columns: [
            {data: 'nome', name: 'cursos.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableEscolaCurso;
}

// Carregando a table
var tableCursoTurno;
function loadTableCursoTurno (idEscolaCurso) {
    // Carregaando a grid
    tableCursoTurno = $('#turnos-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('escola.turno.gridTurnos', {'idEscolaCurso' : idEscolaCurso }),
        columns: [
            {data: 'nome', name: 'turnos.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    return tableCursoTurno;
}

// Função de execução
function runModalAdicionarCursos(idEscola)
{
    // Zerando a grid de disciplinas
    //loadTableCursoTurno(0).ajax.url(laroute.route('curriculo.gridAdicionarDisciplina', {'idEscolaCurso' : 0 })).load();

    //Carregando as grids de situações
    if(tableEscolaCurso) {
        loadTableEscolaCurso(idEscola).ajax.url(laroute.route('escola.gridCursos', {'id' :idEscola })).load();
    } else {
        loadTableEscolaCurso(idEscola);
    }

    // Desabilitando a o select2 e o botão de adicionar
    $('#select-turnos').prop('disabled', true);
    $('#addTurno').prop('disabled', true);

    // Exibindo o modal
    $('#modal-adicionar-cursos').modal({'show' : true});
}

// Id do pivot da escola e curso
var idEscolaCurso, idCurso, indexSelectedRow;

// evento para abrir a grid de disciplina
$(document).on("click", "#cursos-grid tbody tr", function (event) {
    if (tableEscolaCurso.rows().data().length > 0  && $(event.target).is("td")) {
        $(this).parent().find("tr td").removeClass('row_selected');
        $(this).find("td").addClass("row_selected");

        //Recuperando o id do curso selecionado e o index da linha selecionada
        idEscolaCurso = tableEscolaCurso.row($(this).index()).data().idEscolaCurso;
        idCurso = tableEscolaCurso.row($(this).index()).data().id;
        indexSelectedRow = $(this).index() + 1;

        // habilitando o select2 e o botão de adicionar
        $('#select-turnos').prop('disabled', false);
        $('#addTurno').prop('disabled', false);

        //Carregando as grids de turnos
        if(tableCursoTurno) {
            loadTableCursoTurno(idEscolaCurso).ajax.url(laroute.route('curriculo.gridAdicionarDisciplina', {'idCurriculoSerie' :idEscolaCurso })).load();
        } else {
            loadTableCursoTurno(idEscolaCurso);
        }
    }
});

