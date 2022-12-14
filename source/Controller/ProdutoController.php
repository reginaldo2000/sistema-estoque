<?php

namespace Source\Controller;

use Exception;
use Source\DAO\CategoriaDAO;
use Source\DAO\ProdutoDAO;
use Source\DAO\UnidadeMedidaDAO;
use Source\DAO\UsuarioDAO;
use Source\Entity\Produto;
use Source\Utils\Paginacao;

class ProdutoController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaProdutos(array $data): void
    {
        $params= filter_input_array(INPUT_GET);
        $pagina = $data["pagina"] ?? 1;

        $nomeProduto = $params["pesquisa"] ?? "";

        $listaProdutos = ProdutoDAO::listarProdutos($nomeProduto);

        $this->responseView("produto/pagina-produto", [
            "nomePagina" => "Lista de Produtos",
            "listaProdutos" => $listaProdutos,
            "pesquisa" => $nomeProduto
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
            $usuario = UsuarioDAO::getUsuarioById($this->session->get("usuario")->getId());
            if (empty($usuario)) {
                throw new Exception("Usuário não informado", 400);
            }
            $produto = (isset($data["id"]) ? ProdutoDAO::get($data["id"]) : new Produto()) ;
            $produto->setCategoria($categoria);
            $produto->setNome($data["nome"]);
            $produto->setCodigoProduto($data["codigo_produto"]);
            $produto->setCodigoBarras($data["codigo_barras"]);
            $produto->setPrecoEntrada(formataParaFloat($data["preco_entrada"]));
            $produto->setPrecoSaida(formataParaFloat($data["preco_saida"]));
            $produto->setEstoque(str_replace(",", ".", $data["estoque"]));
            $produto->setUnidadeMedida($unidadeMedida);
            $produto->setUsuario($usuario);

            if (empty($produto->getId())) {
                ProdutoDAO::salvar($produto);
                setMessage("Produto cadastrado com sucesso!", "alert-success");
                redirect("/produto/novo");
            } else {
                ProdutoDAO::atualizar($produto, $data["id"]);
                setMessage("Produto atualizado com sucesso!", "alert-success");
                redirect("/produto/editar/{$produto->getId()}");
            }
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

    public function visualizar(array $data)
    {
        try {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            if (!$id) {
                throw new Exception("Id inválido!", 400);
            }
            $produto = ProdutoDAO::get($id);
            $render = $this->renderView("produto/_includes/form-visualizar-produto", [
                "produto" => $produto
            ]);
            $this->responseJson(false, "Produto encontrado!", "alert-success", $render);
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage());
        }
    }

    public function getProduto(array $data): void
    {
        try {
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            if (!$id) {
                throw new Exception("ID inválido, por favor informe um ID válido!");
            }
            $produto = ProdutoDAO::get($id);
            if (empty($produto)) {
                throw new Exception("Produto inexistente!");
            }
            echo json_encode($produto->toArray(), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage());
        }
    }

    public function excluir(array $data): void
    {
        try {
            $id = $data["id"];
            ProdutoDAO::excluir($id);

            $paginacao = new Paginacao(url("/produto/lista"), []);

            $listaProdutos = ProdutoDAO::listarProdutos("", $paginacao);
            $render = $this->renderView("produto/_includes/table-produtos", [
                "listaProdutos" => $listaProdutos
            ]);
            $this->responseJson(false, "Produto excluído com sucesso!", $render);
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage());
        }
    }
}
