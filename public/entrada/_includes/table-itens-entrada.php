<?php foreach ($listaItens as $obj)  : ?>
    <?php $item = unserialize($obj); ?>
    <tr class="align-middle">
        <td><?= $index++; ?></td>
        <td class="text-uppercase"><?= $item->getProduto()->getCodigoProduto(); ?></td>
        <td><?= $item->getProduto()->getNome(); ?></td>
        <td><input type="text" class="form-control" name="<?= $item->getProduto()->getId()."_quantidade"; ?>" value="<?= $item->getQuantidade(); ?>"></td>
        <td><input type="text" class="form-control" name="<?= $item->getProduto()->getId()."_valor_unitario"; ?>" value="<?= formataMoeda($item->getProduto()->getPrecoEntrada()); ?>" onkeyup="formataMoeda(this);"></td>
        <td><input type="text" class="form-control" name="<?= $item->getProduto()->getId()."_valor_total"; ?>" value="<?= formataMoeda($item->getProduto()->getPrecoEntrada() * $item->getQuantidade()); ?>" onkeydown="return false;"></td>
        <td class="text-center">
            <a class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>