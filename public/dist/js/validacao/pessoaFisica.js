// Regras de validação
$(document).ready(function () {

    $("#formPessoaFisica").validate({
        rules: {
            nome: {
                required: true,
                alphaSpace: true,
                maxlength: 200
            },

            sexo_id: {
                required: true,
                integer: true
            },

            estado_civil_id: {
                integer: true
            },

            nacionalidade_id: {
                required: true,
                integer: true
            },

            cgm_municipio_id: {
                required: true,
                integer: true
            },

            escolaridade_id: {
                integer: true
            },

            endereco_id: {
                integer: true
            },

            cnh_categoria_id: {
                integer: true
            },

            num_cgm: {
                number: true,
                maxlength: 30
            },

            cpf: {
                required: true,
                cpfBR: true,
                maxlength: 15,
                unique: [laroute.route('pessoaFisica.searchCpf'), $('#cpf')]
            },

            rg: {
                number: true,
                maxlength: 15

            },

            orgao_emissor: {
                alphaSpace: true,
                maxlength: 30
            },

            pai: {
                alphaSpace: true,
                maxlength: 200
            },

            mae: {
                alphaSpace: true,
                maxlength: 200
            },

            naturalidade: {
                alphaSpace: true,
                maxlength: 100
            },

            inscricao_estadual: {
                number: true,
                maxlength: 30
            },

            data_nascimento: {
                //dateBr: true,
                maxlength: 15
            },

            data_falecimento: {
                //dateBr: true,
                maxlength: 15
            },

            data_expedicao: {
                //dateBr: true,
                maxlength: 15
            },

            data_cadastramento: {
                //dateBr: true,
                maxlength: 15
            },

            data_vencimento_cnh: {
                //dateBr: true,
                maxlength: 15
            },

            email: {
                email: true,
            },

            num_cnh: {
                number: true,
                maxlength: 30
            },

            telefone: {
                number: true,
                maxlength: 18
            },

            'endereco[logradouro]': {
                required: true,
                alphaSpace: true,
                maxlength: 200
            },

            'endereco[numero]': {
                required: true,
                number: true,
                maxlength: 10
            },

            'endereco[complemento]': {
                alphaSpace: true,
                maxlength: 100
            },

            'endereco[cep]': {
                number: true,
                maxlength: 15
            },

            'endereco[bairro_id]': {
                required: true,
                integer: true
            }
        },
        //For custom messages
        /*messages: {
             nome_operadores:{
             required: "Enter a username",
             minlength: "Enter at least 5 characters"
         }
         },*/
        //Define qual elemento será adicionado
        errorElement : 'small',
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        },

        highlight: function(element, errorClass) {
            //console.log("Error");
            $(element).parent().parent().addClass("has-error");
        },
        unhighlight: function(element, errorClass, validClass) {
            //console.log("Sucess");
            $(element).parent().parent().removeClass("has-error");

        }
    });
});