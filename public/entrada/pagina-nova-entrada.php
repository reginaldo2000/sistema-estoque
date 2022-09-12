<?php $this->layout("_theme", ["nomePagina" => "Cadastrar Entrada"]); ?>
<?php include __DIR__ . "/_includes/modal-add-item.php"; ?>
<?php include __DIR__ . "/_includes/modal-finaliza-entrada.php"; ?>

<div id="alerta" class="alert alert-warning alert-dismissible fade show" role="alert" hidden>
    <span></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<?php showMessage(); ?>

<div class="card">

    <div class="card-header">Adicionar Item</div>

    <div class="card-body">

        <form method="POST" action="<?= url("/entrada/add-item"); ?>" class="needs-validation form-ajax" novalidate autocomplete="off" ajax-alert="#alerta" ajax-reset-form="true" ajax-render="#tableItens">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" name="produto_codigo" class="form-control text-uppercase" placeholder="Pesquisar produto" aria-describedby="basic-addon1">
                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="modal" data-bs-target="#modalAddItem" onclick="atualizaTabelaProdutos();">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>

<div class="card mt-3">

    <div class="card-header">
        Itens da Entrada
    </div>

    <div class="card-body">

        <form method="POST" action="<?= url("/entrada/atualizar-valores"); ?>" id="formCalcularValores" class="form-ajax" autocomplete="off" ajax-alert="#alerta" ajax-render="#tableItens">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase" style="width: 5%;">item</th>
                            <th class="text-center text-uppercase">cód.</th>
                            <th class="text-center text-uppercase">produto</th>
                            <th class="text-center text-uppercase" style="width: 8%;">qtde.</th>
                            <th class="text-center text-uppercase" style="width: 15%;">val. unit.</th>
                            <th class="text-center text-uppercase" style="width: 15%;">val. total</th>
                            <th class="text-center text-uppercase" style="width: 8%;">ação</th>
                        </tr>
                    </thead>
                    <tbody id="tableItens">
                        <?php include __DIR__ . "/_includes/table-itens-entrada.php"; ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-refresh"></i> Atualizar Valores
            </button>
        </form>

    </div>

</div>

<button type="submit" class="btn btn-success mt-3" id="btnFinalizaEntrada" data-bs-toggle="modal" data-bs-target="#modalFinalizaEntrada" hidden>
    Finalizar Entrada
</button>
