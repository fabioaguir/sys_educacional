// Regras de validação
$(document).ready(function () {

    $("#formAluno").validate({
        /**/
        rules: {
            'codigo': {
                required: true,
                number: true,
                maxlength: 30
            },

            'num_nis': {
                required: true,
                number: true,
                maxlength: 30
            },

            'num_inep': {
                required: true,
                number: true,
                maxlength: 30
            },

            'cgm[nome]': {
                required: true,
                maxlength: 200,
                alphaSpace: true
            },

            'cgm[data_nascimento]': {
                //required: true,

            },

            'cgm[sexo_id]': {
                required: true,
                integer: true
            },

            'cgm[cpf]': {
                required: true,
                cpfBr: true,
                maxlength: 15,
                unique: [laroute.route('aluno.searchCpf'), $('#idAluno')]
            },

            'cgm[rg]': {
                number: true,
                maxlength: 20
            },

            'cgm[pai]': {
                maxlength: 200,
                required: true,
                alphaSpace: true
            },

            'cgm[mae]': {
                maxlength: 200,
                required: true,
                alphaSpace: true
            },

            'cgm[email]': {
                email: true
            },

            'cgm[nacionalidade_id]': {
                integer: true,
            },

            'cgm[naturalidade]': {
                required: true,
                alphaSpace: true,
                maxlength: 200
            },

            'telefone[nome]': {
                required: true,
                number: true,
                maxlength: 18
            },

            'cgm[endereco][logradouro]': {
                required: true,
                alphaSpace: true,
                maxlength: 200
            },

            'cgm[endereco][zona_id]': {
                integer: true
            },

            'cgm[endereco][numero]': {
                required: true,
                number: true,
                maxlength: 10
            },

            'cgm[endereco][complemento]': {
                alphaSpace: true,
                maxlength: 100
            },

            'cgm[endereco][cep]': {
                required: true,
                number: true,
                maxlength: 15
            },

            'cgm[endereco][bairro_id]': {
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