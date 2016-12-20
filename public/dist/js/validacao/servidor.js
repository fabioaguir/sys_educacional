// Regras de validação
$(document).ready(function () {

   /// $.validator.setDefaults({ ignore: '' });
    $("#formServidor").validate({
        rules: {
            'cgm[nome]': {
                required: true
            },

            'cgm[sexo_id]': {
                required: true
            },
            'cgm[data_nascimento]': {
                required: true
            },
            'cgm[nacionalidade_id]': {
                required: true
            },
            'cgm[cgm_municipio_id]': {
                required: true
            },
            'cgm[estado_civil_id]': {
                required: true
            },
            'cgm[escolaridade_id]': {
                required: true
            },
            'cgm[cpf]': {
                required: true
            },
            'cgm[rg]': {
                required: true
            },
            'cgm[endereco][logradouro]': {
                required: true
            },
            'cgm[endereco][numero]': {
                required: true
            },
            'cgm[endereco][bairro_id]': {
                required: true
            },
            data_admicao: {
                required: true
            },
            carga_horaria: {
                required: true
            },
            tipo_vinculo_servidor_id: {
                required: true
            },
            cargos_id: {
                required: true
            },
            funcoes_id: {
                required: true
            },
            
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