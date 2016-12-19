// Regras de validação
$(document).ready(function () {

    $("#formEscola").validate({
        rules: {
            codigo: {
                required: true
            },

            inep: {
                required: true
            },

            nome: {
                required: true
            },
            portaria: {
                required: true
            },
            dt_pub_portaria: {
                required: true
            },
            'endereco[logradouro]': {
                required: true
            },
            'endereco[numero]': {
                required: true
            },
            'endereco[bairro_id]': {
                required: true
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