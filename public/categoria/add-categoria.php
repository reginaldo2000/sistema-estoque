<?php $this->layout("_theme", ["nomePagina" => "Registrar Entrada"]); ?>

<div id="alert" class="alert alert-dismissible fade show mb-3" role="alert" hidden>
    <span class="message"></span>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<a class="btn btn-primary">
    <i class="fa fa-plus"></i> Adicionar Produto
</a>

<div class="card card-footer mt-3">
    <div class="row">
        <div class="col-lg-3 mb-3">
            <label for="pesquisa">Nome:</label>
            <input type="text" name="nome" id="pesquisa" class="form-control" ajax-param="categoria:nome">
        </div>

        <div class="col-lg-5 mb-3 d-flex align-items-end">
            <button type="button" class="btn btn-primary" ajax-action="post:/categoria/salvar" ajax-target="categoria" ajax-alert="#alert">
                <i class="fa fa-search"></i> Buscar
            </button>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped table-hover mt-3">
    <thead>
        <tr>
            <th class="text-center text-uppercase">descrição</th>
            <th class="text-center text-uppercase"></th>
            <th class="text-center text-uppercase"></th>
            <th class="text-center text-uppercase"></th>
        </tr>
    </thead>
</table>