<div class="modal fade" tabindex="-1" id="modalSalvarUsuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url("/usuario/salvar"); ?>" class="form-ajax needs-validation" autocomplete="off" novalidate>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6 mb-3">
                            <label for="usuario">Usuário:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" class="form-control" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="nomeUsuario">Nome Completo:</label>
                            <input type="text" name="nome_usuario" id="nomeUsuario" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="ATIVO">ATIVO</option>
                                <option value="INATIVO">INATIVO</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>