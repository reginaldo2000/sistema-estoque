<div class="row">
    <div class="col-lg-6 mb-3">
        <labe>Código do Produto:</labe>
        <span class="form-control"><?= ($produto->getCodigoProduto() != "" ? $produto->getCodigoProduto() : "Não informado"); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Código de Barras:</labe>
        <span class="form-control"><?= ($produto->getCodigoBarras() != "" ? $produto->getCodigoBarras() : "Não informado"); ?></span>
    </div>
    <div class="col-lg-12 mb-3">
        <labe>Nome:</labe>
        <span class="form-control"><?= $produto->getNome(); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Categoria:</labe>
        <span class="form-control"><?= $produto->getCategoria()->getNome(); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Unidade de Medida:</labe>
        <span class="form-control"><?= $produto->getUnidadeMedida()->getNome(); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Preço de Entrada:</labe>
        <span class="form-control"><?= formataMoeda($produto->getPrecoEntrada()); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Preço de Saída:</labe>
        <span class="form-control"><?= formataMoeda($produto->getPrecoSaida()); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Data de Modificação:</labe>
        <span class="form-control"><?= $produto->getDataModificacao()->format("Y-m-d H:i"); ?></span>
    </div>
    <div class="col-lg-6 mb-3">
        <labe>Usuário Responsável:</labe>
        <span class="form-control"><?= $produto->getUsuario()->getNomeUsuario(); ?></span>
    </div>
</div>