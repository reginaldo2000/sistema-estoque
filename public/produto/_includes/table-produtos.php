<?php foreach ($listaProdutos as $prod) : ?>
    <tr>
        <td class="text-center align-middle">
            <a class="<?= $prod->getStatus() == "ATIVO" ? "icon-ativo" : "icon-inativo"; ?>"></a>
        </td>
        <td class="text-uppercase"><?= $prod->getCodigoProduto(); ?></td>
        <td><?= $prod->getNome(); ?></td>
        <td><?= $prod->getCategoria()->getNome(); ?></td>
        <td class="text-center"><?= $prod->getEstoque(); ?></td>
        <td class="text-center">
            <a class="text-dark"><i class="material-icons" onclick="visualizarProduto(<?= $prod->getId(); ?>);">visibility</i></a>
        </td>
        <td class="text-center">
            <a href="<?= url("/produto/editar/{$prod->getId()}"); ?>" class="text-dark"><i class="material-icons">edit</i></a>
        </td>
        <td class="text-center">
            <a class="text-danger" ajax-delete="#modalExcluirProduto" ajax-action="<?= url("/produto/dados-produto/{$prod->getId()}"); ?>">
                <i class="material-icons">delete</i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>