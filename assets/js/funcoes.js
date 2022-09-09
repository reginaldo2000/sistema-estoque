function visualizarProduto(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${MAIN_URL}/produto/visualizar/${id}`,
        beforeSend: () => {
            ajaxAbrirModalLoading()
        },
        success: response => {
            if (response.erro) {
                htmlMessageAlert("#alert", response.message, "alert-danger")
                return
            }
            $("#modalVisualizarProduto .modal-body").html(response.render)
            $("#modalVisualizarProduto").modal("show")
            ajaxFecharModalLoading(1000)
        },
        error: erro => {
            ajaxFecharModalLoading(1000)
            htmlMessageAlert("#alert", erro.message, "alert-danger")
            console.log(erro)
        }

    })
}

function selecionarItemProduto(id) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: `${MAIN_URL}/entrada/add-item`,
        data: {
            produto_id: id
        },
        beforeSend: () => {
        },
        success: (response) => {
            $("#tableItens").html(response.render);
            $("#tableItemProduto").html(response.tableProdutos);
            htmlMessageAlert("#alertaInfo", response.message, "alert-info");
        },
        error: (ex) => {
            console.log(ex);
        }
    })
}

function atualizaTabelaProdutos() {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${MAIN_URL}/entrada/atualiza-tabela-produtos`,
        beforeSend: () => {
        },
        success: (response) => {
            $("#tableItemProduto").html(response.render);
        },
        error: (ex) => {
            console.log(ex);
        }
    })
}

function removerItemEntrada(index) {
    $.ajax({
        type: "DELETE",
        dataType: "JSON",
        url: `${MAIN_URL}/entrada/remover-item/${index}`,
        success: response => {
            $("#tableItens").html(response.render);
            htmlMessageAlert("#alerta", response.message, response.messageType);
        },
        error: ex => {
            console.log(ex);
            htmlMessageAlert("#alerta", ex, "alert-danger");
        }
    })
}