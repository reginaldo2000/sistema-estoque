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
            $listaCategorias = CategoriaDAO::listar($params["nome"] ?? "", $paginacao);
            $paginacao->setTotalResultados(CategoriaDAO::getMaxRow());

            $this->responseView("categoria/pagina-categoria", [
                "nomePagina" => "Lista de Produtos",
                "listaCategorias" => $listaCategorias,
                "paginacao" => $paginacao,
                "pesquisa" => $params["nome"] ?? ""
            ]);
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }

    public function salvar(array $data): void
    {
        try {
            $id = $data["id"] != "" ? $data["id"] : null;

            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria->setNome($data["nome"]);

            if ($categoria->getId() == null) {
                CategoriaDAO::salvar($categoria);
                $this->responseJson(false, "Categoria cadastrada com sucesso!");
            } else {
                CategoriaDAO::atualizar($categoria, $id);
                $this->responseJson(false, "Categoria atualizada com sucesso!");
            }

        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        }
    }

    public function getCategoria(array $data): void
    {
        try {
            $id = $data["id"];
            $categoria = CategoriaDAO::get($id);

            if (empty($categoria)) {
                throw new Exception("Categoria não encontrada!", 400);
            }

            echo json_encode($categoria->toArray(), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        }
    }

    public function excluir(array $data): void {
        try {
            $id = $data["id"];
            CategoriaDAO::excluir($id);
            $this->responseJson(false, "Categoria excluída com sucesso!", "alert-success");
        } catch(Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        }
    }
}
