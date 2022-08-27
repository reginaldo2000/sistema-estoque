<?php $this->layout("_theme", ["nomePagina" => "Lista de Categorias"]); ?>
<?php $this->insert("categoria/_includes/modal-salvar-categoria"); ?>

<div id="alert" class="alert alert-dismissible fade show mb-3" role="alert" hidden>
    <span class="message"></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSalvarCategoria">
    <i class="fa fa-plus"></i> Nova Categoria
</a>

<div class="card card-footer mt-3">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="pesquisa">Pesquisar:</label>
            <input type="text" id="pesquisa" class="form-control" ajax-param="pesquisa:nome">
        </div>

        <div class="col-lg-5 mb-3 d-flex align-items-end">
            <button type="button" class="btn btn-primary" ajax-action="get:/categoria/pesquisar/1" ajax-target="pesquisa" ajax-render="#tableCategorias" ajax-alert="#alert">
                <i class="fa fa-search"></i> Buscar
            </button>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped table-hover mt-3">
    <thead>
        <tr>
            <th class="text-center text-uppercase">descrição</th>
            <th class="text-center text-uppercase">modificação</th>
            <th class="text-center text-uppercase" colspan="2" style="width: 15%;">ações</th>
        </tr>
    </thead>
    <tbody id="tableCategorias">
        <?php include_once __DIR__ . "/_includes/table-categorias.php"; ?>
    </tbody>

</table>