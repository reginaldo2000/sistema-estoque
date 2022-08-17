<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>
<?php $this->insert("usuario/_includes/_modal-salvar-usuario"); ?>
<?php $this->insert("usuario/_includes/_modal-excluir-usuario"); ?>

<div id="alert" class="alert alert-dismissible" role="alert" hidden>
    <span></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalSalvarUsuario">
    <i class="fa fa-plus"></i> Novo Usuário
</a>

<div class="card card-footer">
    <form method="GET" action="<?= url("/usuario/lista"); ?>" autocomplete="off">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label for="pesquisa">Pesquisar:</label>
                <input type="text" name="pesquisa" id="pesquisa" class="form-control">
            </div>

            <div class="col-lg-3 mb-3 d-flex align-items-end">
                <button class="btn btn-primary">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center text-uppercase">usuário</th>
                <th class="text-center text-uppercase">nome do usuário</th>
                <th class="text-center text-uppercase">data modificação</th>
                <th class="text-center text-uppercase" colspan="2">ações</th>
            </tr>
        </thead>
        <tbody id="tableUsuarios">
            <?php include __DIR__ . "/_includes/_table-usuarios.php"; ?>
        </tbody>
    </table>
</div>