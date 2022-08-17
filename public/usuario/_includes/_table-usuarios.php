<?php foreach ($listaUsuarios as $u) : ?>
    <tr>
        <td><?= $u->getUsuario(); ?></td>
        <td><?= $u->getNomeUsuario(); ?></td>
        <td><?= $u->getDataModificacao()->format("d/m/Y H:i"); ?></td>
        <td class="text-center">
            <a href="#"><i class="fa fa-pencil fs-18 text-dark"></i></a>
        </td>
        <td class="text-center">
            <a href="#"><i class="fa fa-trash fs-18 text-danger"></i></a>
        </td>
    </tr>
<?php endforeach; ?>