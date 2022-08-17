<div class="modal fade" tabindex="-1" id="modalExcluirUsuario">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url("/usuario/excluir"); ?>" class="form-ajax needs-validation" autocomplete="off" novalidate ajax-close-modal="true" ajax-reset-form="true" ajax-render="#tableUsuarios" ajax-alert="#alert">
                <div class="modal-body">

                    <input type="hidden" name="_method" value="DELETE" hidden>
                    <input type="text" name="id" ajax-delete-id="id" hidden required>
                    <p>Deseja realmente excluir o usuário?</p>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>