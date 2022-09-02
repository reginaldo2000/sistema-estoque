<?php if (!empty($listaProdutos)) : ?>
    <?php foreach ($listaProdutos as $produto) : ?>
        <tr>
            <td><?= $produto->getCodigoProduto(); ?></td>
            <td><?= $produto->getNome(); ?></td>
            <td class="text-center">
                <a class="text-success">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="3">Nenhum produto encontrado!</td>
    </tr>
<?php endif; ?>