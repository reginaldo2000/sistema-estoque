<?php

namespace Source\Controller;

use ArrayObject;
use Exception;
use Source\DAO\EntradaDAO;
use Source\DAO\ItemEntradaDAO;
use Source\DAO\ProdutoDAO;
use Source\DAO\UsuarioDAO;
use Source\Entity\Entrada;
use Source\Entity\ItemProduto;
use Source\Entity\Produto;
use Source\Exception\InternalErrorException;

/**
 * Description of EntradaController
 *
 * @author Reginaldo
 */
class EntradaController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
        $this->verificaUsuarioAutenticado();
    }

    public function paginaEntrada(array $data): void
    {
        try {
            $listaEntradas = EntradaDAO::listar();
            $this->responseView("entrada/pagina-entrada", [
                "listaEntradas" => $listaEntradas
            ]);
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }

    public function paginaNovaEntrada(array $data): void
    {
        try {
            if (isset($data["id"])) {
                $this->init($data["id"]);
            }
            if (!isset($data["id"]) && !$this->session->has("entradaKey")) {
                $this->session->set("entradaKey", md5(date("U")));
            }
            $listaItens = $this->listaItens();

            $listaProdutos = ProdutoDAO::listarProdutos();
            $this->responseView("entrada/pagina-nova-entrada", [
                "nomePagina" => (isset($data["id"])?"Editar Entrada":"Nova Entrada"),
                "listaProdutos" => $listaProdutos,
                "listaItens" => $listaItens,
                "index" => 1
            ]);
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }

    public function addItem(array $data): void
    {
        try {
            $listaItens = $this->listaItens();
            $produto = $this->retornaProduto($data);

            $item = new ItemProduto();
            $item->setProduto($produto);
            $item->setQuantidade(1.000);
            $item->setValorUnitario($produto->getPrecoEntrada());
            $item->setValorTotal($produto->getPrecoEntrada());
            $item->setChave($this->session->get("entradaKey"));
            ItemEntradaDAO::salvar($item);

            $listaItens->append($item);

            $tableItens = $this->renderView("/entrada/_includes/table-itens-entrada", [
                "listaItens" => $listaItens,
                "index" => 1
            ]);

            $tableProdutos = $this->atualizaTabelaProdutos();

            $response = [
                "render" => $tableItens,
                "tableProdutos" => $tableProdutos,
                "message" => "Produto adicionado com sucesso!",
                "messageType" => "alert-info",
                "error" => false
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            $this->responseJson(true, "Não deu certo!" . $e, "alert-danger");
        }
    }

    public function removerItem(array $data): void
    {
        try {
            $itemId = $data["index"];

            ItemEntradaDAO::excluir($itemId);

            $tableItens = $this->renderView("/entrada/_includes/table-itens-entrada", [
                "listaItens" => $this->listaItens(),
                "index" => 1
            ]);

            $this->responseJson(false, "Item removido da lista!", "alert-info", $tableItens);
        } catch (Exception $e) {
            $this->responseJson(false, "Erro ao remover o item!", "alert-danger");
        }
    }

    public function tabelaProdutos(): void
    {
        $tableProdutos = $this->atualizaTabelaProdutos();
        $response = [
            "render" => $tableProdutos
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function atualizarValores(array $data): void
    {
        $listaItens = $this->listaItens();

        foreach ($listaItens as $item) {
            $novoItem = $item;
            $idProduto = $novoItem->getProduto()->getId();

            if ($data[$idProduto . "_quantidade"] == 0) {
                $this->responseJson(true, "Quantidade deve ser maior que zero para o produto \"" . $novoItem->getProduto()->getNome() . "\"", "alert-warning");
                return;
            }

            $novoItem->setQuantidade(formataParaFloat($data[$idProduto . "_quantidade"]));
            $novoItem->setValorUnitario(formataParaFloat($data[$idProduto . "_valor_unitario"]));
            $novoItem->setValorTotal(formataParaFloat($data[$idProduto . "_valor_unitario"]) * $novoItem->getQuantidade());

            ItemEntradaDAO::atualizar($novoItem, $novoItem->getId());
        }

        $tableItens = $this->renderView("/entrada/_includes/table-itens-entrada", [
            "listaItens" => $this->listaItens(),
            "index" => 1
        ]);

        $this->responseJson(false, "Valores recalculados com sucesso!", "alert-info", $tableItens);
    }

    public function finalizar(array $data): void
    {
        try {
            if ($this->session->has("entradaId_" . $this->session->get("entradaKey"))) {
                $this->editarEntrada($data);
            }

            $listaItens = $this->listaItens();
            if (empty($listaItens)) {
                setMessage("Lista vazia!!!", "alert-warning");
                redirect("/entrada/nova");
            }
            $usuarioLogado = $this->session->get("usuario");

            $entrada = new Entrada();
            $entrada->setDescricao($data["descricao"]);
            $entrada->setCodigoNota($data["codigo_nota"]);
            $entrada->setUsuario(UsuarioDAO::getUsuarioById($usuarioLogado->getId()));
            $entrada->setStatus($data["status"]);

            foreach ($listaItens as $itemProduto) {
                $itemProduto->setEntrada($entrada);
                $entrada->getListaItemProdutos()->add($itemProduto);
                $entrada->setValorTotal($entrada->getValorTotal() + $itemProduto->getValorTotal());

                if ($entrada->getStatus() == "FINALIZADA") {
                    $this->atualizaDadosProduto($itemProduto);
                }
            }
            EntradaDAO::salvar($entrada);
            $this->session->remove("entradaKey");
            $mensagem = ($entrada->getStatus() == "FINALIZADA" ? "Entrada finalizada com sucesso!" : "Entrada salva com sucesso!");
            setMessage($mensagem, "alert-success");
            redirect("/entrada/nova");
        } catch (Exception $e) {
            echo $e;
            // redirect("/oops/{$e->getCode()}");
        }
    }

    public function visualizar(array $data): void
    {
        try {
            $entradaId = $data["id"];
            $entrada = EntradaDAO::get($entradaId);

            $render = $this->renderView("entrada/_includes/dados-entrada", [
                "entrada" => $entrada
            ]);

            $this->responseJson(false, "", "", $render);
        } catch (InternalErrorException $e) {
            $this->responseJson(true, $e->getMessage(), "alert-danger");
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage(), "alert-warning");
        }
    }

    private function init(int $entradaId): void
    {
        $entrada = EntradaDAO::get($entradaId);

        foreach ($entrada->getListaItemProdutos() as $item) {
            $this->session->set("entradaId_" . $item->getChave(), $entrada->getId());
            $this->session->set("entradaKey", $item->getChave());
            break;
        }
    }

    private function listaItens(): ArrayObject
    {
        $listaItens = new ArrayObject();
        if ($this->session->has("entradaKey")) {
            $key = $this->session->get("entradaKey");
            $listaItens = ItemEntradaDAO::listarItensEntradaTemp($key);
        }
        return $listaItens;
    }

    private function retornaProduto(array $data): Produto
    {
        if (isset($data["produto_id"])) {
            return ProdutoDAO::get($data["produto_id"]);
        }
        return ProdutoDAO::getByCodigo($data["produto_codigo"]);
    }

    private function atualizaTabelaProdutos(): string
    {
        $listaItens = $this->listaItens();

        $listaIds = [];
        foreach ($listaItens as $item) {
            array_push($listaIds, $item->getProduto()->getId());
        }
        $ids = implode(",", $listaIds) != "" ? implode(",", $listaIds) : "0";

        $tableProdutos = $this->renderView("/entrada/_includes/table-produtos", [
            "listaProdutos" => ProdutoDAO::listarProdutosByIds($ids)
        ]);

        return $tableProdutos;
    }

    private function atualizaDadosProduto(ItemProduto $itemProduto): void
    {
        $produto = $itemProduto->getProduto();
        $novoPreco = ($produto->getPrecoEntrada() > $itemProduto->getValorUnitario() ? $produto->getPrecoEntrada() : $itemProduto->getValorUnitario());
        $produto->setPrecoEntrada($novoPreco);
        $produto->setPrecoSaida(($novoPreco * 1.35));
        $produto->setEstoque($itemProduto->getQuantidade() + $produto->getEstoque());
        ProdutoDAO::atualizar($produto, $produto->getId());
    }

    private function editarEntrada(array $data): void
    {
        $entradaId = $this->session->get("entradaId_" . $this->session->get("entradaKey"));
        $entrada = EntradaDAO::get($entradaId);

        if ($data["status"] == "EM_EDICAO") {
            $this->atualizarEntrada($entrada);
        }

        $entrada->setStatus($data["status"]);
        $entrada->setDescricao($data["descricao"]);
        $entrada->setCodigoNota($data["codigo_nota"]);

        $valorTotal = 0.0;
        foreach ($this->listaItens() as $itemProduto) {
            $itemProduto->setEntrada($entrada);
            $entrada->getListaItemProdutos()->add($itemProduto);
            $entrada->setValorTotal($valorTotal += $itemProduto->getValorTotal());

            if ($entrada->getStatus() == "FINALIZADA") {
                $this->atualizaDadosProduto($itemProduto);
            }
        }
        EntradaDAO::atualizar($entrada);

        $this->session->remove("entradaKey");
        $this->session->remove("entradaId_" . $this->session->get("entradaKey"));
        setMessage("Entrada finalizada com sucesso!", "alert-success");
        redirect("/entrada/lista");
    }

    private function atualizarEntrada(Entrada $entrada): void
    {
        $valorTotal = 0.0;
        foreach ($this->listaItens() as $itemProduto) {
            $itemProduto->setEntrada($entrada);
            $entrada->getListaItemProdutos()->add($itemProduto);
            $entrada->setValorTotal($valorTotal += $itemProduto->getValorTotal());

            if ($entrada->getStatus() == "FINALIZADA") {
                $this->atualizaDadosProduto($itemProduto);
            }
        }

        EntradaDAO::atualizar($entrada);

        $this->session->remove("entradaKey");
        $this->session->remove("entradaId_" . $this->session->get("entradaKey"));
        setMessage("Entrada salva com sucesso!", "alert-success");
        redirect("/entrada/lista");
    }


    public function teste(): void
    {
    }
}
