// Regras de validação
$(document).ready(function () {

    $("#formFormaAvaliacao").validate({
        rules: {
            nome: {
                required: true,
                alphaSpace: true,
                maxlength: 100
            },

            codigo: {
                required: true,
                maxlength: 50
            },

            tipo_resultado_id: {
                required: true,
                integer: true
            }

            /*'nome' => 'required|max:100|unique:formas_avaliacoes,nome',
             'codigo' => 'required|max:50|unique:formas_avaliacoes,codigo',
             'tipo_resultado_id' => 'required'*/
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