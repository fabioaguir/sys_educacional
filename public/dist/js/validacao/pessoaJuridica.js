// Regras de validação
$(document).ready(function () {

    $("#formPessoaJuridica").validate({
        rules: {
            nome: {
                required: true,
                alphaSpace: true,
                maxlength: 200
            },

            cgm_municipio_id: {
                required: true,
                integer: true
            },

            cnpj: {
                unique: [laroute.route('pessoaJuridica.searchCnpj'), $('#idPessoaJuridica')],
                required: true,
                //cnpj: true

            },

            nome_complemento: {
                required: true,
                alphaSpace: true
            },

            nome_fantasia: {
                required: true,
                alphaSpace: true
            },

            num_cgm: {
                required: true,
                alphaSpace: true
            },

            data_cadastramento: {
                dateBr: true
            },

            email: {
                email: true
            },

            tipo_empresa_id: {
                required: true,
                integer: true
            },

            nire: {
                number: true
            },

            tipo_cadastro: {
                integer: true
            },

            inscricao_estadual: {
                number: true
            },

            endereco_id: {
                integer: true
            },

            'telefone[nome]': {
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