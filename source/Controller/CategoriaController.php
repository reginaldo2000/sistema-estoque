<?php

namespace Source\Controller;

use Exception;
use Source\DAO\CategoriaDAO;
use Source\DAO\ProdutoDAO;
use Source\DAO\UnidadeMedidaDAO;
use Source\DAO\UsuarioDAO;
use Source\Entity\Categoria;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Produto;

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
        $categoria = new Categoria();
        $categoria->setNome($data["nome"]);
        CategoriaDAO::salvar($categoria);
        $this->responseJson(false, "categoria cadastrada!");
    }

    public function pesquisar(array $data): void {
        $nomeCategoria = filter_var($data["nome"], FILTER_SANITIZE_SPECIAL_CHARS);
        $listaCategorias = CategoriaDAO::listar($nomeCategoria);
        $this->responseJson(false, "", "", "", $listaCategorias);
    }
}
