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
                ajaxAlerta(true, "#alert", response.message)
                return
            }
            $("#modalVisualizarProduto .modal-body").html(response.render)
            $("#modalVisualizarProduto").modal("show")
            ajaxFecharModalLoading(1000)
        },
        error: erro => {
            ajaxFecharModalLoading(1000)
            ajaxAlerta(true, "#alert", erro.message)
            console.log(erro)
        }
        
    })
}