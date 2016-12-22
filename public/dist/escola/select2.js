//consulta via select2
$("#select-cursos").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    width: 250,
    ajax: {
        type: 'POST',
        url: laroute.route('escola.curso.select2'),
        dataType: 'json',
        delay: 250,
        crossDomain: true,
        data: function (params) {
            return {
                'search': params.term,
                'page': params.page || 1,
                'idEscola':  idEscola
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


//consulta via select2
$("#select-turnos").select2({
    placeholder: 'Selecione:',
    theme: "bootstrap",
    width: 650,
    ajax: {
        type: 'POST',
        url: laroute.route('escola.turno.select2'),
        dataType: 'json',
        delay: 250,
        crossDomain: true,
        data: function (params) {
            return {
                'search': params.term,
                'page': params.page || 1,
                'idEscolaCurso':  idEscolaCurso
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

