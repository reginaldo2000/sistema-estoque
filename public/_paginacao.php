<nav aria-label="..." class="text-center">
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link">voltar</a>
        </li>

        <?php for ($i = 1; $i <= 36/10; $i++) : ?>
            <li class="page-item <?= ($paginacao->getPagina() == $i ? "active" : ""); ?>"><a class="page-link"><?= $i; ?></a></li>
        <?php endfor; ?>

        <li class="page-item">
            <a class="page-link" onclick="ajaxRequest(this, 'GET', '<?= $paginacao->getRoute().'/'.$paginacao->getProximaPagina(); ?>', {});">próximo</a>
        </li>
    </ul>
</nav>