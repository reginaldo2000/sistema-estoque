<?php foreach ($listaItens as $item) : ?>
    <tr>
        <td><?= $index++; ?></td>
        <td><?= $item->getProduto()->getCodigoProduto(); ?></td>
        <td><?= $item->getProduto()->getNome(); ?></td>
        <td><?= $item->getQuantidade(); ?></td>
        <td><?= $item->getProduto()->getPrecoEntrada(); ?></td>
        <td><?= $item->getProduto()->getPrecoEntrada(); ?></td>
    </tr>
<?php endforeach; ?>