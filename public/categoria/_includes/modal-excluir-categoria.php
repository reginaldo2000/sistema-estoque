<div class="modal fade" tabindex="-1" id="modalExcluirCategoria">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="<?= url("/categoria/excluir"); ?>" autocomplete="off" class="form-ajax needs-validation" novalidade ajax-alert="#alert" ajax-close-modal="true">
                <input type="text" name="id" ajax-delete-id="id" hidden required>
                <div class="modal-body">
                    <p>Deseja realmente excluir a categoria?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-danger">Sim</button>
                </div>
            </form>

        </div>
    </div>
</div>