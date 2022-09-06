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

function selecionarItemProduto(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${MAIN_URL}/produto/dados-produto/${id}`,
        beforeSend: () => {
        }, 
        success: (response) => {
            document.getElementById("produtoNome").value = response.nome;
            document.getElementById("produtoId").value = response.id;
            $("#modalAddItem").modal("hide");
            htmlMessageAlert("#alerta", "Produto selecionado!", "alert-info");
            // setTimeout(() => {
            //     $("#alerta").attr("hidden", true)
            // }, 2000)
        }
    })
}