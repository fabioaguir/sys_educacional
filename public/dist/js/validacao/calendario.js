// Regras de validação
$(document).ready(function () {

    $("#formCalendario").validate({
        rules: {
            nome: {
                required: true,
                alphaSpace: true,
                maxlength: 150
            },
            ano: {
                required: true,
                alphaSpace: true,
                maxlength: 4
            },
            duracoes_id: {
                required: true
            },
            data_inicial: {
                required: true,
                maxlength: 10
            },
            data_final: {
                required: true,
                maxlength: 10
            },
            data_resultado_final: {
                required: true,
                maxlength: 10
            },
            status_id: {
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