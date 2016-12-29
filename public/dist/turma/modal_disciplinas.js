
// Carregando a table
var tableDisciplina;
function loadTableDisciplina (idTurma) {
    // Carregando a grid
    tableDisciplina = $('#disciplina-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false,
        ajax: laroute.route('turma.disciplina.grid', {'id' : idTurma }),
        columns: [
            {data: 'codigo', name: 'disciplinas.codigo', orderable: false},
            {data: 'nome', name: 'disciplinas.nome'},
            {data: 'periodo', name: 'curriculos_series_disciplinas.periodo', orderable: false},
            {data: 'e_obrigatoria', name: 'e_obrigatoria', orderable: false}
        ]
    });

    return tableDisciplina;
}

// Função de execução
function runModalDisciplinas(idTurma)
{
    //Carregando as grids de situações
    if(tableDisciplina) {
        loadTableDisciplina(idTurma).ajax.url(laroute.route('turma.disciplina.grid', {'id' : idTurma })).load();
    } else {
        loadTableDisciplina(idTurma);
    }

    // Exibindo o modal
    $('#modal-disciplinas').modal({'show' : true});
}

//consulta via select2
$("#select-disciplinas").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    width: "100%",
    allowClear: true,
    ajax: {
        type: 'POST',
        url: laroute.route('turma.disciplina.select2'),
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