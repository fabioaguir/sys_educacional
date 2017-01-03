// Regras de validação
$(document).ready(function () {

    $("#formInstituicao").validate({
        rules: {
            nome: {
                required: true,
                maxlength: 100
            },

            cnpj: {
                required: true,
                maxlength: 35
            },

            insc_municipal: {
                required: true,
                maxlength: 60
            },

            insc_estadual: {
                required: true,
                maxlength: 60
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