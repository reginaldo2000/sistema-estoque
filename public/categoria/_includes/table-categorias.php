<?php if (!empty($listaCategorias)) : ?>
    <?php foreach ($listaCategorias as $categoria) : ?>
        <tr>
            <td class="text-center">
                <a class="<?= $categoria->getStatus() == "ATIVO" ? "icon-ativo" : "icon-inativo"; ?>"></a>
            </td>
            <td><?= $categoria->getNome(); ?></td>
            <td><?= $categoria->getDataModificacao()->format("d/m/Y H:i"); ?></td>
            <td class="text-center">
                <a class="text-dark" ajax-edit="#modalSalvarCategoria" ajax-action="<?= url("/categoria/dados-categoria/{$categoria->getId()}"); ?>">
                    <i class="material-icons">edit</i>
                </a>
            </td>
            <td class="text-center">
                <a class="text-danger" ajax-delete="#modalExcluirCategoria" ajax-action="<?= url("/categoria/dados-categoria/{$categoria->getId()}"); ?>">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="4">Nenhuma categoria encontrada!</td>
    </tr>
<?php endif; ?>