<?php $this->layout("_theme", ["nomePagina" => "Lista de Categorias"]); ?>
<?php $this->insert("categoria/_includes/modal-salvar-categoria"); ?>
<?php $this->insert("categoria/_includes/modal-excluir-categoria"); ?>

<div id="alert" class="alert alert-dismissible fade show mb-3" role="alert" hidden>
    <span class="message"></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSalvarCategoria">
    <i class="fa fa-plus"></i> Nova Categoria
</a>

<div class="card card-footer mt-3">
    <form method="GET" action="<?= url("/categoria/lista/1"); ?>" autocomplete="off" onsubmit="ajaxAbrirModalLoading();">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <label for="pesquisa">Pesquisar:</label>
                <input type="text" name="nome" id="pesquisa" class="form-control" value="<?= $pesquisa; ?>">
            </div>

            <div class="col-lg-5 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>
</div>
<table class="table table-bordered table-striped table-hover mt-3">
    <thead>
        <tr>
            <th class="text-center text-uppercase">status</th>
            <th class="text-center text-uppercase">descrição</th>
            <th class="text-center text-uppercase">modificação</th>
            <th class="text-center text-uppercase" colspan="2" style="width: 15%;">ações</th>
        </tr>
    </thead>
    <tbody id="tableCategorias">
        <?php include_once __DIR__ . "/_includes/table-categorias.php"; ?>
    </tbody>
</table>

<div class="paginacao">
    <?php include __DIR__ . "/../_paginacao.php"; ?>
</div>