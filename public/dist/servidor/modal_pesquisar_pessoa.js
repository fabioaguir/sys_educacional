// Carregando a table
// Carregando a table
var tablePesquisarPessoa;
function loadTablePesquisarPessoa() {

    tablePesquisarPessoa = $('#pesquisar-pessoa-grid').DataTable({
        retrieve: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 5,
        bLengthChange: false,
        autoWidth: false,
        ajax: laroute.route('pessoaFisica.gridPesquisarPessoa'),
        columns: [
            {data: 'nome', name: 'nome'},
            {data: 'mae', name: 'mae'},
            {data: 'cpf', name: 'cpf'}
        ]
    });

    return tablePesquisarPessoa;
}

// Selecionar as tr da grid
$(document).on('click', '#pesquisar-pessoa-grid tbody tr', function () {
    // Aplicando o estilo css
    if($(this).hasClass("selected")) {
        $(this).removeClass("selected");
    } else {
        $(this).addClass("selected");
    }
});

// Evento para quando clicar na tr da table de pacientes
$(document).on('click', '#pesquisar-pessoa-grid tbody tr', function () {


    // Varrendo as linhas
    $("#pesquisar-pessoa-grid tbody tr.selected").each(function (index, value) {

        $('#cgm_id').val(tablePesquisarPessoa.row($(value).index()).data().id);
        $('#nome').val(tablePesquisarPessoa.row($(value).index()).data().nome);
        $('#numero_nis').val(tablePesquisarPessoa.row($(value).index()).data().numero_nis);
        $('#data_nascimento').val(tablePesquisarPessoa.row($(value).index()).data().data_nascimento);
        $('#cpf').val(tablePesquisarPessoa.row($(value).index()).data().cpf);
        $('#rg').val(tablePesquisarPessoa.row($(value).index()).data().rg);
        $('#pai').val(tablePesquisarPessoa.row($(value).index()).data().pai);
        $('#mae').val(tablePesquisarPessoa.row($(value).index()).data().mae);
        $('#telefone').val(tablePesquisarPessoa.row($(value).index()).data().fone);
        $('#email').val(tablePesquisarPessoa.row($(value).index()).data().email);
        $('#logradouro').val(tablePesquisarPessoa.row($(value).index()).data().logradouro);
        $('#numero').val(tablePesquisarPessoa.row($(value).index()).data().numero);
        $('#complemento').val(tablePesquisarPessoa.row($(value).index()).data().complemento);
        $('#cep').val(tablePesquisarPessoa.row($(value).index()).data().cep);
        $('#naturalidade').val(tablePesquisarPessoa.row($(value).index()).data().naturalidade);
        $('#endereco_id').val(tablePesquisarPessoa.row($(value).index()).data().endereco_id);
        $('#inscricao_estadual').val(tablePesquisarPessoa.row($(value).index()).data().inscricao_estadual);
        $('#orgao_emissor').val(tablePesquisarPessoa.row($(value).index()).data().orgao_emissor);
        $('#data_expedicao').val(tablePesquisarPessoa.row($(value).index()).data().data_expedicao);
        $('#num_cnh').val(tablePesquisarPessoa.row($(value).index()).data().num_cnh);
        $('#data_vencimento_cnh').val(tablePesquisarPessoa.row($(value).index()).data().data_vencimento_cnh);
        $('#carteira_prof').val(tablePesquisarPessoa.row($(value).index()).data().carteira_prof);
        $('#serie_carteira').val(tablePesquisarPessoa.row($(value).index()).data().serie_carteira);
        $('#numero_titulo').val(tablePesquisarPessoa.row($(value).index()).data().numero_titulo);
        $('#numero_sessao').val(tablePesquisarPessoa.row($(value).index()).data().numero_sessao);
        $('#numero_zona').val(tablePesquisarPessoa.row($(value).index()).data().numero_zona);
        $('#data_falecimento').val(tablePesquisarPessoa.row($(value).index()).data().data_falecimento);

        var sexo = tablePesquisarPessoa.row($(value).index()).data().sexo_id;

        $( "#sexo_id option" ).each(function() {
            if($(this).val() == sexo) {
                $(this).prop('selected', true);
            }
        });

        var nacionalidade = tablePesquisarPessoa.row($(value).index()).data().nacionalidade_id;

        $( "#nacionalidade_id option" ).each(function() {
            if($(this).val() == nacionalidade) {
                $(this).prop('selected', true);
            }
        });

        var zona = tablePesquisarPessoa.row($(value).index()).data().zona_id;

        $( "#zona_id option" ).each(function() {
            if($(this).val() == zona) {
                $(this).prop('selected', true);
            }
        });

        var estado = tablePesquisarPessoa.row($(value).index()).data().estado_id;

        $( "#estado option" ).each(function() {
            if($(this).val() == estado) {
                $(this).prop('selected', true);
            }
        });

        var cidade    = tablePesquisarPessoa.row($(value).index()).data().cidade;
        var cidadeId  = tablePesquisarPessoa.row($(value).index()).data().cidade_id;

        if(cidadeId) {
            var option = '<option value="' + cidadeId + '">' + cidade + '</option>';

            $('#cidade option').remove();
            $('#cidade').append(option);
        } else {
            $('#cidade option').remove();
        }

        var bairro    = tablePesquisarPessoa.row($(value).index()).data().bairro;
        var bairroId  = tablePesquisarPessoa.row($(value).index()).data().bairro_id;

        if(bairroId) {
            var option = '<option value="' + bairroId + '">' + bairro + '</option>';

            $('#bairro option').remove();
            $('#bairro').append(option);
        } else {
            $('#bairro option').remove();
        }

        var estadoCivil = tablePesquisarPessoa.row($(value).index()).data().estado_civil_id;

        $( "#estado_civil_id option" ).each(function() {
            if($(this).val() == estadoCivil) {
                $(this).prop('selected', true);
            }
        });

        var cgmMunicipio = tablePesquisarPessoa.row($(value).index()).data().cgm_municipio_id;

        $( "#cgm_municipio_id option" ).each(function() {
            if($(this).val() == cgmMunicipio) {
                $(this).prop('selected', true);
            }
        });

        var escolaridade = tablePesquisarPessoa.row($(value).index()).data().escolaridade_id;

        $( "#escolaridade_id option" ).each(function() {
            if($(this).val() == escolaridade) {
                $(this).prop('selected', true);
            }
        });

        var cnhCategoria = tablePesquisarPessoa.row($(value).index()).data().cnh_categoria_id;

        $( "#cnh_categoria_id option" ).each(function() {
            if($(this).val() == cnhCategoria) {
                $(this).prop('selected', true);
            }
        });

    });

    // Fechando o modal
    $('#modal-pesquisar-pessoa').modal('toggle');

});

//Evento do click no botão adicionar período
$(document).on('click', '#nome-search', function (event) {

    if (tablePesquisarPessoa) {
        loadTablePesquisarPessoa().ajax.url(laroute.route('pessoaFisica.gridPesquisarPessoa')).load();
    } else {
        loadTablePesquisarPessoa();
    }

    // Exibindo o modal
    $('#modal-pesquisar-pessoa').modal({'show': true});

});








