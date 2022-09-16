<div class="row">
    <div class="col-lg-6 mb-3">
        <span>Descrição da entrada:</span>
        <span class="form-control"><?= $entrada->getDescricao(); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <span>Código da nota:</span>
        <span class="form-control"><?= $entrada->getCodigoNota() ?: "Não informado"; ?></span>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 mb-3">
        <span>Valor total:</span>
        <span class="form-control">R$ <?= formataMoeda($entrada->getValorTotal()); ?></span>
    </div>
    <div class="col-lg-3 mb-3">
        <span>Status:</span>
        <span class="form-control"><?= $entrada->getStatus(); ?></span>
    </div>
    <div class="col-lg-3 mb-3">
        <span>Status:</span>
        <span class="form-control"><?= $entrada->getDataCriacao()->format("d/m/Y H:i"); ?></span>
    </div>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="align-middle">
            <th class="text-center text-uppercase">cod.</th>
            <th class="text-center text-uppercase">produto</th>
            <th class="text-center text-uppercase">qtde.</th>
            <th class="text-center text-uppercase">val. unit.</th>
            <th class="text-center text-uppercase">val. total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entrada->getListaItemProdutos() as $item) : ?>
            <tr>
                <td><?= $item->getProduto()->getCodigoProduto(); ?></td>
                <td><?= $item->getProduto()->getNome(); ?></td>
                <td><?= $item->getQuantidade(); ?></td>
                <td><?= formataMoeda($item->getValorUnitario()); ?></td>
                <td><?= formataMoeda($item->getValorTotal()); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>