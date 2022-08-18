<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>

<div id="alert" class="alert alert-dismissible" role="alert" hidden>
    <span></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<?php showMessage(); ?>

<a href="<?= url("/produto/novo"); ?>" class="btn btn-primary mb-3">
    <i class="fa fa-plus"></i> Novo Produto
</a>