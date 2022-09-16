<?php $this->layout("_theme", ["nomePagina" => "Registrar Entrada"]); ?>
<?php include __DIR__ . "/_includes/modal-visualizar-entrada.php"; ?>

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


<table class="table table-bordered table-striped table-hover mt-3" id="tableEntrada" pagination="true" max-rows="<?= count($listaEntradas); ?>" rows="10">
    <thead>
        <tr>
            <th class="text-center text-uppercase">código</th>
            <th class="text-center text-uppercase">descrição</th>
            <th class="text-center text-uppercase">total</th>
            <th class="text-center text-uppercase">status</th>
            <th class="text-center text-uppercase">data</th>
            <th class="text-center text-uppercase" colspan="3">ações</th>
        </tr>
    </thead>
    <?php if (!empty($listaEntradas)) : ?>
        <?php foreach ($listaEntradas as $entrada) : ?>
            <tr class="align-middle">
                <td><?= $entrada->getCodigoNota(); ?></td>
                <td><?= $entrada->getDescricao(); ?></td>
                <td><?= formataMoeda($entrada->getValorTotal()); ?></td>
                <td><?= $entrada->getStatus(); ?></td>
                <td><?= $entrada->getDataCriacao()->format("d/m/Y"); ?></td>
                <td class="text-center">
                    <div class="dropdown">
                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog"></i> Opções
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="visualizarEntrada(<?= $entrada->getId(); ?>);">Visualizar</a></li>
                            <?php if ($entrada->getStatus() != "FINALIZADA") : ?>
                                <li><a class="dropdown-item" href="<?= url("/entrada/editar/{$entrada->getId()}"); ?>">Editar</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item">Cancelar</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="8">Nenhuma entrada encontrada!</td>
        </tr>
    <?php endif; ?>
</table>

<nav aria-label="Page navigation example" style="width: 100%;display:flex;justify-content: center;">
    <ul class="pagination"></ul>
</nav>