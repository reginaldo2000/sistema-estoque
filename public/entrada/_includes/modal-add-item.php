<div class="modal fade" tabindex="-1" id="modalAddItem">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-footer">
                    <form action="" method="post" class="form-ajax">
                        <div class="row">
                            <div class="col-lg-9 mb-2 mt-2">
                                <input type="text" name="pesquisa_produto" class="form-control">
                            </div>
                            <div class="col-lg-3 mb-2 mt-2">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase">código</th>
                                <th class="text-center text-uppercase">produto</th>
                                <th class="text-center text-uppercase">ação</th>
                            </tr>
                        </thead>
                        <tbody id="tableItemProduto">
                            <?php include __DIR__."/table-produtos.php"; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>