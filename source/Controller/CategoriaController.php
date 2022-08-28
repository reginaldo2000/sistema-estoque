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

    public function paginaCategoria(array $data): void
    {
        try {
            $params = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
            $pagina = isset($data["pagina"]) ? $data["pagina"] : 1;

            $paginacao = new Paginacao(url("/categoria/lista"), $params, $pagina);
            $listaCategorias = CategoriaDAO::listar($params["nome"], $paginacao);
            $paginacao->setTotalResultados(CategoriaDAO::getMaxRow());

            $this->responseView("categoria/pagina-categoria", [
                "nomePagina" => "Lista de Produtos",
                "listaCategorias" => $listaCategorias,
                "paginacao" => $paginacao
            ]);
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
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
}
