<?php

namespace Source\Controller;

use Exception;
use Source\DAO\CategoriaDAO;
use Source\DAO\ProdutoDAO;
use Source\Entity\Produto;

class ProdutoController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaProdutos(): void
    {
        $this->responseView("produto/pagina-produto", [
            "nomePagina" => "Lista de Produtos"
        ]);
    }

    public function paginaNovoProduto(): void
    {
        $listaCategorias = CategoriaDAO::listar();
        $this->responseView("produto/pagina-novo-produto", [
            "nomePagina" => "Novo Produto",
            "listaCategorias" => $listaCategorias
        ]);
    }

    public function salvar(array $data): void
    {
        try {
            $categoria = CategoriaDAO::get($data["categoria_id"]);
            if(empty($categoria)) {
                redirect("/oops/400");
            }
            $produto = new Produto();
            $produto->setCategoria($categoria);
            $produto->setNome($data["nome"]);
            $produto->setCodigoProduto($data["codigo_produto"]);
            $produto->setCodigoBarras($data["codigo_barras"]);
            $produto->setPrecoEntrada(str_replace(",", ".", $data["preco_entrada"]));
            $produto->setPrecoSaida(str_replace(",", ".", $data["preco_saida"]));
            $produto->setEstoque(str_replace(",", ".", $data["estoque"]));
            $produto->setUnidadeMedida($data["unidade_medida"]);
            ProdutoDAO::salvar($produto);

            setMessage("Produto cadastrado com sucesso!", "alert-success");
            redirect("/produto/lista");
        } catch (Exception $e) {
            setMessage($e->getMessage(), "alert-danger");
            redirect("/produto/lista");
        }
    }
}
