$.validator.addMethod("unique",
    function(value, element, params) {
        var isUnique = false;
        if(value == '')
            return isUnique;

        id_send= '';
        if(params[1] !='')
            id_send ='id='+params[1]+'&';

        $.ajax({
            url: params[0],
            type : 'POST',
            async: false,
            data: { idCliente : params[1], value : value},
            dataType: 'json',
            cache: true,
            success: function(data){
                console.log(data);
                if (data.success == false) {
                    isUnique = true;
                }
            }
        });

        return isUnique;

    },
    $.validator.format("Este número já se encontra cadastrado")
);