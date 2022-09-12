<?php if (!empty($listaItens)) : ?>
    <?php foreach ($listaItens as $item) : ?>
        <tr class="align-middle">
            <td class="text-center"><?= $index++; ?></td>
            <td class="text-uppercase"><?= $item->getProduto()->getCodigoProduto(); ?></td>
            <td><?= $item->getProduto()->getNome(); ?></td>
            <td><input type="text" class="form-control" name="<?= $item->getProduto()->getId() . "_quantidade"; ?>" value="<?= $item->getQuantidade(); ?>"></td>
            <td><input type="text" class="form-control" name="<?= $item->getProduto()->getId() . "_valor_unitario"; ?>" value="<?= formataMoeda($item->getValorUnitario()); ?>" onkeyup="formataMoeda(this);"></td>
            <td><input type="text" class="form-control" name="<?= $item->getProduto()->getId() . "_valor_total"; ?>" value="<?= formataMoeda($item->getValorTotal()); ?>" onkeydown="return false;"></td>
            <td class="text-center">
                <a class="btn btn-danger" onclick="removerItemEntrada(<?= ($index - 2); ?>);">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="7">Nenhum item adicionado!</td>
    </tr>
<?php endif; ?>