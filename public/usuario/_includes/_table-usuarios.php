<?php if (count($listaUsuarios) > 0) : ?>
    <?php foreach ($listaUsuarios as $u) : ?>
        <tr>
            <td><?= $u->getUsuario(); ?></td>
            <td><?= $u->getNomeUsuario(); ?></td>
            <td><?= $u->getDataModificacao()->format("d/m/Y H:i"); ?></td>
            <td class="text-center">
                <a href="#" class="text-dark" ajax-edit="#modalSalvarUsuario" ajax-action="<?= url("/usuario/dados-usuario/{$u->getId()}"); ?>">
                    <i class="material-icons">edit</i>
                </a>
            </td>
            <td class="text-center">
                <a href="#" class="text-danger" ajax-delete="#modalExcluirUsuario" ajax-action="<?= url("/usuario/dados-usuario/{$u->getId()}"); ?>">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="6">Nenhum usuário encontrado!</td>
    </tr>
<?php endif; ?>