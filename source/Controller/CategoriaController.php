<?php

namespace Source\Controller;

use Exception;
use Source\DAO\CategoriaDAO;
use Source\Entity\Categoria;
use Source\Utils\Paginacao;

class CategoriaController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaCategoria(): void
    {
        $paginacao = new Paginacao("/categoria/pesquisar");
        $listaCategorias = CategoriaDAO::listar("", $paginacao);

        $this->responseView("categoria/pagina-categoria", [
            "nomePagina" => "Lista de Produtos",
            "listaCategorias" => $listaCategorias,
            "paginacao" => $paginacao
        ]);
    }

    public function salvar(array $data): void
    {
        try {

            $categoria = new Categoria();
            $categoria->setNome($data["nome"]);
            CategoriaDAO::salvar($categoria);
            $this->responseJson(false, "categoria cadastrada!");
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        }
    }

    public function pesquisar(array $data): void
    {
        try {
            $nomeCategoria = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_SPECIAL_CHARS);

            $paginacao = new Paginacao("/categoria/pesquisar", $data["pagina"]);
            $listaCategorias = CategoriaDAO::listar($nomeCategoria, $paginacao);

            $render = $this->renderView("categoria/_includes/table-categorias", [
                "listaCategorias" => $listaCategorias,
                "paginacao" => $paginacao
            ]);

            $this->responseJson(false, "", "", $render);
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        }
    }
}
