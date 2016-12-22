/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

//Função para listar as períodos
function periodos(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('calendario.getPeriodo'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um período</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#periodo option').remove();
        $('#periodo').append(option);
    });
}

periodos("");