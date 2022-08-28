<?php if (!empty($listaCategorias)) : ?>
    <?php foreach ($listaCategorias as $categoria) : ?>
        <tr>
            <td><?= $categoria->getNome(); ?></td>
            <td><?= $categoria->getDataModificacao()->format("d/m/Y H:i"); ?></td>
            <td class="text-center">
                <a class="text-dark">
                    <i class="material-icons">edit</i>
                </a>
            </td>
            <td class="text-center">
                <a class="text-danger">
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
