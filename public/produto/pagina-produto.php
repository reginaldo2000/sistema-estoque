<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>
<?php $this->insert("produto/_includes/modal-visualizar-produto"); ?>
<?php $this->insert("produto/_includes/modal-excluir-produto"); ?>

<div id="alert" class="alert alert-dismissible" role="alert" hidden>
    <span></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<?php showMessage(); ?>

<a href="<?= url("/produto/novo"); ?>" class="btn btn-primary mb-3">
    <i class="fa fa-plus"></i> Novo Produto
</a>

<div class="card card-footer">
    <form method="POST" action="<?= url("/produto/listar"); ?>" autocomplete="off">
        <div class="row">
            <div class="col-lg-4 mt-2 mb-3">
                <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Nome do produto">
            </div>

            <div class="col-lg-4 mb-3 d-flex align-items-end">
                <div class="form-floating">
                    <button type="submit" class="btn btn-primary">
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive mt-3">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center text-uppercase">status</th>
                <th class="text-center text-uppercase">código</th>
                <th class="text-center text-uppercase">nome do produto</th>
                <th class="text-center text-uppercase">categoria</th>
                <th class="text-center text-uppercase">estoque</th>
                <th class="text-center text-uppercase" colspan="3">ações</th>
            </tr>
        </thead>
        <tbody id="tableProdutos">
            <?php include_once __DIR__."/_includes/table-produtos.php"; ?>
        </tbody>
    </table>
</div>

<?php $this->start("scripts"); ?>
<script>
    const visualizarProduto = id => {
        ajaxAbrirModalLoading()
        fetch(`${MAIN_URL}/produto/visualizar/${id}`)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    if (data.erro) {
                        ajaxAlerta(true, "#alert", data.message)
                        return
                    }
                    $("#modalVisualizarProduto .modal-body").html(data.render)
                    $("#modalVisualizarProduto").modal("show")
                })
                .catch(erro => {
                    console.log(erro)
                })
        ajaxFecharModalLoading(1000)
    }
</script>
<?php $this->end(); ?>