<?php foreach ($listaItens as $item2)  : ?>
    <?php $item = unserialize($item2); ?>
    <tr class="align-middle">
        <td><?= $index++; ?></td>
        <td class="text-uppercase"><?= $item->getProduto()->getCodigoProduto(); ?></td>
        <td><?= $item->getProduto()->getNome(); ?></td>
        <td><input type="text" class="form-control" value="<?= $item->getQuantidade(); ?>"></td>
        <td><input type="text" class="form-control" value="<?= formataMoeda($item->getProduto()->getPrecoEntrada()); ?>" onkeyup="formataMoeda(this);"></td>
        <td><input type="text" class="form-control" value="<?= formataMoeda($item->getProduto()->getPrecoEntrada()); ?>" onkeyup="formataMoeda(this);"></td>
        <td class="text-center">
            <a class="btn btn-primary">
                <i class="fa fa-save"></i>
            </a>
        </td>
        <td class="text-center">
            <a class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>