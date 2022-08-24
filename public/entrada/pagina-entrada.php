<?php $this->layout("_theme", ["nomePagina" => "Registrar Entrada"]); ?>

<a class="btn btn-primary">
    <i class="fa fa-plus"></i> Adicionar Produto
</a>

<div class="card card-footer mt-3">
    <form method="GET" action="" autocomplete="off">
        <div class="row">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="pesquisa">Pesquisa:</label>
                    <input type="text" name="pesquisa" id="pesquisa" class="form-control">
                </div>
            </div>

            <div class="col-lg-5 d-flex align-items-end">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Buscar <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
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