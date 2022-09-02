<?php $this->layout("_theme", ["nomePagina" => "Registrar Entrada"]); ?>

<a href="<?= url("/entrada/nova"); ?>" class="btn btn-primary">
    <i class="fa fa-plus"></i> Nova Entrada
</a>

<div class="card card-footer mt-3">
    <form id="form" autocomplete="off">
        <div class="row">
            <div class="col-lg-5 mb-3">
                <label for="pesquisa">Pesquisa:</label>
                <input type="text" name="pesquisa" id="pesquisa" class="form-control">
            </div>

            <div class="col-lg-5 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>
</div>

<table class="table table-bordered table-striped table-hover mt-3">
    <thead>
        <tr>
            <th class="text-center text-uppercase">descrição</th>
            <th class="text-center text-uppercase">código</th>
            <th class="text-center text-uppercase">total</th>
            <th class="text-center text-uppercase">data</th>
            <th class="text-center text-uppercase">ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($listaEntradas)) : ?>
            <?php foreach ($listaEntradas as $entrada) : ?>
                <tr>
                    <td><?= $entrada->getDescricao(); ?></td>
                    <td><?= $entrada->getCodigoNota(); ?></td>
                    <td><?= $entrada->getValorTotal(); ?></td>
                    <td><?= $entrada->getDataCriacao(); ?></td>
                    <td><?= $entrada->getStatus(); ?></td>
                    <td>
                        <a class="text-dark">
                            <i class="material-icons">visibility</i>
                        </a>
                    </td>
                    <td>
                        <a class="text-dark">
                            <i class="material-icons">edit</i>
                        </a>
                    </td>
                    <td>
                        <a class="text-danger">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="8">Nenhuma entrada encontrada!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>