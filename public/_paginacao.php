<nav aria-label="..." class="mt-3">
    <ul class="pagination">
        <li class="page-item <?= ($paginacao->getPagina() == 1 ? "disabled" : ""); ?>">
            <a href="<?= $paginacao->getPaginaAnterior(); ?>" class="page-link">&#60;&#60;</a>
        </li>

        <?php for ($i = (intval($paginacao->getPagina() / 5) * 5) + 1; $i <= $paginacao->getNumeroPaginas() && $i < (5 * (intval($i / 5) + 2)); $i++) : ?>
            <li class="page-item <?= ($paginacao->getPagina() == $i ? "active" : ""); ?>">
                <a href="<?= $paginacao->escolherPagina($i); ?>" class="page-link"><?= $i; ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= ($paginacao->getPagina() == $paginacao->getNumeroPaginas() ? "disabled" : ""); ?>">
            <a href="<?= $paginacao->getProximaPagina(); ?>" class="page-link">&#62;&#62;</a>
        </li>
    </ul>
</nav>