<?php $this->layout("_theme", ["nomePagina" => "Cadastrar Entrada"]); ?>
<?php include __DIR__ . "/_includes/modal-add-item.php"; ?>

<div class="card">
    <div class="card-header">Adicionar Item</div>
    <div class="card-body">
        <form action="" id="" class="needs-validation form-ajax" novalidate autocomplete="off">

            <input type="text" name="produto_id" id="produtoId" hidden>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" name="produto_nome" id="produtoNome" class="form-control" placeholder="Pesquisar produto" aria-describedby="basic-addon1">
                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="modal" data-bs-target="#modalAddItem">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 d-flex align-items-end">
                    <button class="btn btn-primary">
                        Adicionar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>