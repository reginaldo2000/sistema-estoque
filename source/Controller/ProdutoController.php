<?php

namespace Source\Controller;

use Exception;
use Source\DAO\CategoriaDAO;
use Source\DAO\ProdutoDAO;
use Source\DAO\UnidadeMedidaDAO;
use Source\Entity\Produto;
use Source\Entity\UnidadeMedida;

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

    public function paginaNovoProduto(array $data): void
    {
        try {
            $listaCategorias = CategoriaDAO::listar();
            $listaUnidadesMedida = UnidadeMedidaDAO::listar();
            $this->responseView("produto/pagina-novo-produto", [
                "nomePagina" => "Novo Produto",
                "listaCategorias" => $listaCategorias,
                "listaUnidadesMedida" => $listaUnidadesMedida
            ]);
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }

    public function salvar(array $data): void
    {
        try {
            $categoria = CategoriaDAO::get($data["categoria_id"]);
            if (empty($categoria)) {
                redirect("/oops/400");
            }
            $unidadeMedida = UnidadeMedidaDAO::get($data["unidade_medida_id"]);
            if (empty($unidadeMedida)) {
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
            $produto->setUnidadeMedida($unidadeMedida);
            ProdutoDAO::salvar($produto);

            setMessage("Produto cadastrado com sucesso!", "alert-success");
            redirect("/produto/novo");
        } catch (Exception $e) {
            setMessage($e->getMessage(), "alert-danger");
            redirect("/produto/lista");
        }
    }

    public function paginaEditarProduto(array $data): void
    {
        try {
            $produto = null;
            if (isset($data["id"])) {
                $produto = ProdutoDAO::get($data["id"]);
            }

            if (empty($produto)) {
                throw new Exception("Recurso não encontrado!", 400);
            }

            $listaCategorias = CategoriaDAO::listar();
            $listaUnidadesMedida = UnidadeMedidaDAO::listar();
            $this->responseView("produto/pagina-editar-produto", [
                "nomePagina" => "Editar Produto",
                "listaCategorias" => $listaCategorias,
                "produto" => $produto,
                "listaUnidadesMedida" => $listaUnidadesMedida
            ]);
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }
}
