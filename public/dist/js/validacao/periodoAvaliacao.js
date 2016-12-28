// Regras de validação
$(document).ready(function () {

    $("#formPeriodoAvaliacao").validate({
        rules: {
            data_inicial: {
                required: true,
                dateBr: true,
                maxlength: 15
            },

            data_final: {
                required: true,
                dateBr: true,
                maxlength: 15
            },

            dias_letivos: {
                required: true,
                integer: true,
                maxlength: 15
            },

            semanas_letivas: {
                required: true,
                integer: true,
                maxlength: 15
            },

            total_dias_letivos: {
                required: true,
                integer: true,
                maxlength: 15
            },

            total_semanas_letivas: {
                required: true,
                integer: true,
                maxlength: 15
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