<div class="modal" tabindex="-1" id="modalSalvarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" ajax-param="categoria:nome">
                            <label>Nome da Categoria:</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" ajax-action="post:/categoria/salvar" ajax-target="categoria" ajax-render="#tableCategorias" ajax-alert="#alert">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div>