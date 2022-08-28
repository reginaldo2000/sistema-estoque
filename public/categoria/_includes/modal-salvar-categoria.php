<div class="modal fade" tabindex="-1" id="modalSalvarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="<?= url("/categoria/salvar"); ?>" autocomplete="off" id="formSalvarCategoria" class="form-ajax needs-validation" novalidade ajax-alert="#alert" ajax-close-modal="true">
                <div class="modal-body">
                    <input type="text" name="id" id="id" class="form-control" hidden>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" name="nome" id="nome" class="form-control" required>
                                <label>Nome da Categoria:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        Salvar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>