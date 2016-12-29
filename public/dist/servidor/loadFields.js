/**
 * Created by Fabio Aguiar on 22/12/2016.
 */

//Função para listar os tipos de telefones
function tipoTelefone(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getTipoTelefone'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um tipo</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#tipoTelefone option').remove();
        $('#tipoTelefone').append(option);
    });
}

tipoTelefone("");

//Função para listar os regimes
function regimes(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getRegimes'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um regime</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#regime option').remove();
        $('#regime').append(option);
    });
}

regimes("");

//Função para listar as áreas
function areas(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getAreas'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma área</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#area option').remove();
        $('#area').append(option);
    });
}

areas("");

//Função para listar os ensinos
function ensinos(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getEnsinos'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um ensino</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#ensino option').remove();
        $('#ensino').append(option);
    });
}

ensinos("");

//Função para listar as disciplinas
function disciplinas(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getDisciplinas'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma disciplina</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#disciplina option').remove();
        $('#disciplina').append(option);
    });
}

disciplinas("");

//Função para listar as cursos formação
function cursos(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getCursos'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione um curso</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#curso option').remove();
        $('#curso').append(option);
    });
}

cursos("");

//Função para listar as instituicoes formação
function instituicoes(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getInstituicoes'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma instituição</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#instituicao option').remove();
        $('#instituicao').append(option);
    });
}

instituicoes("");

//Função para listar as situacoes formação
function situacoes(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getSituacoes'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma situação</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#situacao option').remove();
        $('#situacao').append(option);
    });
}

situacoes("");

//Função para listar as licenciaturas formação
function licenciaturas(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getLicenciaturas'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#licenciatura option').remove();
        $('#licenciatura').append(option);
    });
}

licenciaturas("");

//Função para listar as funções
function funcoes(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getFuncoes'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        option += '<option value="">Selecione uma função</option>';
        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#funcao option').remove();
        $('#funcao').append(option);
    });
}

funcoes("");

//Função para listar as funções
function posgraduacoes(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getPos'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#select-posgraduacao option').remove();
        $('#select-posgraduacao').append(option);
    });
}

posgraduacoes("");

$("#select-posgraduacao").select2({
    theme: "bootstrap",
    width: "100%"
});

//Função para listar as funções
function outroscursos(id) {
    jQuery.ajax({
        type: 'POST',
        url: laroute.route('servidor.getOutrosCursos'),
        datatype: 'json',
    }).done(function (json) {
        var option = '';

        for (var i = 0; i < json.length; i++) {
            if (json[i]['id'] == id) {
                option += '<option selected value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            } else {
                option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
            }
        }

        $('#select-outroscursos option').remove();
        $('#select-outroscursos').append(option);
    });
}

outroscursos("");

$("#select-outroscursos").select2({
    theme: "bootstrap",
    width: "100%"
});