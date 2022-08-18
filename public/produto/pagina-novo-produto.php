<?php $this->layout("_theme", ["nomePagina" => $nomePagina]); ?>

<form method="POST" action="<?= url("/produto/salvar"); ?>" autocomplete="off" class="needs-validation" novalidate>
    <div class="row">

        <div class="col-lg-4 mb-3">
            <label for="codigoProduto">Código do Produto:</label>
            <input type="text" name="codigo_produto" id="codigoProduto" class="form-control">
        </div>

        <div class="col-lg-4 mb-3">
            <label for="codigoBarras">Código de Barras:</label>
            <input type="text" name="codigo_barras" id="codigoBarras" class="form-control">
        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-3">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-3">
            <label for="categoria">Categoria:</label>
            <select name="categoria_id" id="categoria" class="form-control" required>
                <option value="">Selecione uma...</option>
                <?php foreach ($listaCategorias as $cat) : ?>
                    <option value="<?= $cat->getId(); ?>"><?= $cat->getNome(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-3">
            <label for="precoEntrada">Preço de Entrada:</label>
            <input type="text" name="preco_entrada" id="precoEntrada" class="form-control" value="0,00" required>
        </div>

        <div class="col-lg-4 mb-3">
            <label for="precoSaida">Preço de Saída:</label>
            <input type="text" name="preco_saida" id="precoSaida" class="form-control" value="0,00" required>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-3">
            <label for="estoque">Estoque:</label>
            <input type="text" name="estoque" id="estoque" class="form-control" value="0,000" required>
        </div>

        <div class="col-lg-4 mb-3">
            <label for="unidadeMedida">Unidade de Medida:</label>
            <select name="unidade_medida" id="unidadeMedida" class="form-control" required>
                <option value="UN">UN</option>
                <option value="KG">KG</option>
                <option value="ML">ML</option>
            </select>
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