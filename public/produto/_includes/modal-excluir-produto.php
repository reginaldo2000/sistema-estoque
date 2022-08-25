<div class="modal fade" tabindex="-1" id="modalExcluirProduto">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url("/produto/excluir"); ?>" class="form-ajax needs-validation" novalidate ajax-render="#tableProdutos" ajax-alert="#alert" ajax-close-modal="true" ajax-reset-form="true">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="text" name="id" ajax-delete-id="id" hidden required>
                    Deseja realmente excluir produto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>