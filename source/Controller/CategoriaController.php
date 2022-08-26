<?php

namespace Source\Controller;

use Exception;
use Source\DAO\CategoriaDAO;
use Source\Entity\Categoria;

class CategoriaController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaCategoria(): void
    {
        $this->responseView("categoria/add-categoria", [
            "nomePagina" => "Lista de Produtos"
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
            $nomeCategoria = filter_var($data["nome"], FILTER_SANITIZE_SPECIAL_CHARS);
            $listaCategorias = CategoriaDAO::listar($nomeCategoria);
            $this->responseJson(false, "", "", "", $listaCategorias);
        } catch(Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        }
        
    }
}
