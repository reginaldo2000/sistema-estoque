<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>
<?php $this->insert("usuario/_includes/_modais/_modal-salvar-usuario"); ?>

<div class="row">
    <div class="col-lg-12">

    </div>
</div>

<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalSalvarUsuario">
    <i class="fa fa-plus"></i> Novo Usuário
</a>

<div class="card card-footer">
    <form method="GET" action="" autocomplete="off">
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
        <tbody>
            <?php foreach ($listaUsuarios as $u) : ?>
                <tr>
                    <td><?= $u->getUsuario(); ?></td>
                    <td><?= $u->getNomeUsuario(); ?></td>
                    <td><?= $u->getDataModificacao()->format("d/m/Y H:i"); ?></td>
                    <td class="text-center">
                        <a href="#"><i class="fa fa-pencil fs-18 text-dark"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#"><i class="fa fa-trash fs-18 text-danger"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
