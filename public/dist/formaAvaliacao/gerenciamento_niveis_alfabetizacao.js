// Gereciamento de niveis de alfabetização

// Referencia global a table de telefones
var objNivelTable;

// Função construtora da table de telefones para editar
function TableNivelEdit(id) {
    // Atributo que amazenará o id da forma de avaliação
    var idTable = id;

    // Atributo que armazenará a table
    var table = $('#nivel-alfabetizacao-grid').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        ajax: laroute.route('formaAvaliacao.nivelAlfabetizacao.grid', {'id' : idTable}),
        columns: [
            {data: 'codigo', name: 'niveis_alfabetizacao.codigo'},
            {data: 'nome', name: 'niveis_alfabetizacao.nome'},
            {data: 'minimo', name: 'minimo'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    // Recupera a table carregada
    this.getTable = function () {
        return table;
    }

    // Eliminando a table
    this.tableDestroy = function () {
        this.getTable().destroy();
    }

    // Método para remover um nível do banco
    this.destroyNivel = function (id) {
        // Requisição ajax
        jQuery.ajax({
            type: 'POST',
            url: laroute.route('formaAvaliacao.nivelAlfabetizacao.destroy', {'id' : id}),
            datatype: 'json',
        }).done(function (json)  {
            if(json.success) {
                swal(json.msg, 'Click no botão abaixo', 'success');
            } else {
                swal(json.msg, 'Click no botão abaixo', 'error');
            }


            // Recarregando a grid
            table.ajax.reload();
        });
    }

    // Método que persisti um nível no banco
    this.newNivel = function () {
        // Recuperando os dados
        var codigo = $('#codigo_nivel_alfabetizacao').val();
        var nome   = $('#nome_nivel_alfabetizacao').val();
        var minimo_aprovacao = $('#min_aprovacao_nivel_alfabetizacao').is(':checked') ? 1 : 0;

        // Dados para envio
        var dados = {
            'codigo': codigo,
            'nome': nome,
            'minimo_aprovacao': minimo_aprovacao,
            'forma_avaliacao_id': idTable
        };

        // Verificando se foi passado valor válido
        if (!codigo || !nome) {
            swal('Você deve informar o nível e a descrição!', "Click no botão abaixo!", 'error');
            return false;
        }

        // Requisição ajax
        jQuery.ajax({
            type: 'POST',
            url: laroute.route('formaAvaliacao.nivelAlfabetizacao.store'),
            data: dados,
            datatype: 'json',
        }).done(function (json)  {
            // Limpando os campos
            $('#codigo_nivel_alfabetizacao').val("");
            $('#nome_nivel_alfabetizacao').val("");
            $('#min_aprovacao_nivel_alfabetizacao').prop('checked', false);

            // Recarregando a grid
            table.ajax.reload();
        });
    };
}

// Função construtora da table de telefones para criar
function TableNivelCreate() {
    // Atributo que armazenará a table
    var table = $('#nivel-alfabetizacao-grid').DataTable({
        iDisplayLength: 5,
        bLengthChange: false,
        bFilter: false,
        autoWidth: false
    });

    // Recupera a table carregada
    this.getTable = function () {
        return table;
    }

    // Eliminando a table
    this.tableDestroy = function () {
        this.getTable().destroy();
    }

    // Método que persisti o telefone no banco
    this.newNivel = function (_objDom) {
        // Recuperando os dados
        var codigo = $('#codigo_nivel_alfabetizacao').val();
        var nome   = $('#nome_nivel_alfabetizacao').val();
        var min_aprovacao = $('#min_aprovacao_nivel_alfabetizacao').is(':checked') ? "Sim" : "Não";

        // Verificando se foi passado valor válido
        if (!codigo || !nome) {
            swal('Você deve informar o nível e a descrição!', "Click no botão abaixo!", 'error');
            return false;
        }

        // Limpando os campos
        $('#codigo_nivel_alfabetizacao').val("");
        $('#nome_nivel_alfabetizacao').val("");
        $('#min_aprovacao_nivel_alfabetizacao').prop('checked', false);

        // Regra par manter somente um mínimo para aprovação
        if(min_aprovacao == "Sim") {
            // Percorrendo todos os conteudos
            table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                // Recuperando os dados da linha atual
                var data = this.data();

                // Setando a célula
                data[2] = 'Não';

                // Atualizando na datatables
                this.data(data);
            });
        }

        // Adicionando a linha na tabela
        table.row.add(
            [
                codigo,
                nome,
                min_aprovacao,
                '<a class="btn btn-xs btn-primary" onclick="objNivelTable.destroyPhone(this)" title="Remover"><i class="glyphicon glyphicon-remove"></i></a>'
            ]
        ).draw( false );
    };

    // Método para remover a linha da grid
    this.destroyPhone = function (_objDom) {
        // Removendo a linha da grid
        table.row( $(_objDom).parents('tr') )
            .remove()
            .draw();
    }
}