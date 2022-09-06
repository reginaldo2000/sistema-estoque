<?php if (!empty($listaProdutos)) : ?>
    <?php foreach ($listaProdutos as $produto) : ?>
        <tr>
            <td class="text-uppercase"><?= $produto->getCodigoProduto(); ?></td>
            <td><?= $produto->getNome(); ?></td>
            <td class="text-center align-middle">
                <a style="color: #2f4f4f; font-size: 1.2rem;" onclick="selecionarItemProduto(<?= $produto->getId(); ?>);">
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