<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>

<div class="row">
    <div class="col-lg-8">
        <?php showMessage(); ?>
    </div>
</div>

<form method="POST" action="<?= url("/produto/salvar"); ?>" autocomplete="off" class="needs-validation" novalidate>
    <div class="row">

        <div class="col-lg-4 mb-3">
            <div class="form-floating">
                <input type="text" name="codigo_produto" id="codigoProduto" class="form-control">
                <label for="codigoProduto">Código do Produto:</label>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="form-floating">
                <input type="text" name="codigo_barras" id="codigoBarras" class="form-control">
                <label for="codigoBarras">Código de Barras:</label>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-3">
            <div class="form-floating">
                <input type="text" name="nome" id="nome" class="form-control" required>
                <label for="nome">Nome do Produto:</label>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-3">
            <div class="form-floating">
                <select name="categoria_id" id="categoria" class="form-control" required>
                    <option value="">Selecione uma...</option>
                    <?php foreach ($listaCategorias as $cat) : ?>
                        <option value="<?= $cat->getId(); ?>"><?= $cat->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="categoria">Categoria:</label>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-3">
            <div class="form-floating">
                <input type="text" name="preco_entrada" id="precoEntrada" class="form-control" value="0,00" required>
                <label for="precoEntrada">Preço de Entrada:</label>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="form-floating">
                <input type="text" name="preco_saida" id="precoSaida" class="form-control" value="0,00" required>
                <label for="precoSaida">Preço de Saída:</label>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-3">
            <div class="form-floating">
                <input type="text" name="estoque" id="estoque" class="form-control" value="0,000" required>
                <label for="estoque">Estoque:</label>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="form-floating">
                <select name="unidade_medida_id" id="unidadeMedida" class="form-control" required>
                    <?php foreach ($listaUnidadesMedida as $unidade) : ?>
                        <option value="<?= $unidade->getId(); ?>"><?= $unidade->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="unidadeMedida">Unidade de Medida:</label>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="painel">
                <a href="<?= url("/produto/lista"); ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
    </div>

</form>