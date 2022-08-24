<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>
<?php $this->insert("produto/_includes/modal-visualizar-produto"); ?>

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
        <tbody>
            <?php foreach ($listaProdutos as $prod) : ?>
                <tr>
                    <td></td>
                    <td><?= $prod->getCodigoProduto(); ?></td>
                    <td><?= $prod->getNome(); ?></td>
                    <td><?= $prod->getCategoria()->getNome(); ?></td>
                    <td class="text-center"><?= $prod->getEstoque(); ?></td>
                    <td class="text-center">
                        <a class="text-dark"><i class="material-icons" onclick="visualizarProduto(<?= $prod->getId(); ?>);">visibility</i></a>
                    </td>
                    <td class="text-center">
                        <a href="<?= url("/produto/editar/{$prod->getId()}"); ?>" class="text-dark"><i class="material-icons">edit</i></a>
                    </td>
                    <td class="text-center">
                        <a class="text-danger"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
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