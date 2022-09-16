<?php

namespace Source\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Source\DAO\EntradaDAO;
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
                "listaEntradas" => $listaEntradas,
                "maxRows" => EntradaDAO::getMaxRow()
            ]);
        } catch (Exception $e) {
        }
    }

    public function paginaNovaEntrada(array $data): void
    {
        try {
            $listaItens = [];
            if ($this->session->has("listaItens") && !isset($data["id"])) {
                $this->session->remove("listaItens");
            }
            if(isset($data["id"])) {
                $entrada = EntradaDAO::get($data["id"]);
                $listaItens = $entrada->getListaItemProdutos();
                // var_dump($listaItens);
                // exit;
                $this->session->set("listaItens", $listaItens);
            }
            $listaProdutos = ProdutoDAO::listarProdutos();
            $this->responseView("entrada/pagina-nova-entrada", [
                "listaProdutos" => $listaProdutos,
                "listaItens" => $listaItens,
                "index" => 1
            ]);
        } catch (Exception $e) {
            redirect("/oops/500");
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

            array_push($listaItens, $item);
            $this->session->set("listaItens", $listaItens);

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
            $this->responseJson(true, "Não deu certo!" . $e->getMessage(), "alert-danger");
        }
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
        $listaItens = [];
        if ($this->session->has("listaItens")) {
            $listaItens = $this->session->get("listaItens");
        }

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

    public function tabelaProdutos(): void
    {
        $response = [
            "render" => $this->atualizaTabelaProdutos()
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function atualizarValores(array $data): void
    {
        $listaItens = $this->listaItens();

        $novaListaItens = [];
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

            array_push($novaListaItens, $novoItem);
        }

        $this->session->set("listaItens", $novaListaItens);

        $tableItens = $this->renderView("/entrada/_includes/table-itens-entrada", [
            "listaItens" => $novaListaItens,
            "index" => 1
        ]);

        $this->responseJson(false, "Valores recalculados com sucesso!", "alert-info", $tableItens);
    }

    public function removerItem(array $data): void
    {
        try {
            $listaItens = $this->listaItens();
            $index = $data["index"];

            unset($listaItens[$index]);

            $listaItens = array_values($listaItens);

            $this->session->set("listaItens", $listaItens);

            $tableItens = $this->renderView("/entrada/_includes/table-itens-entrada", [
                "listaItens" => $listaItens,
                "index" => 1
            ]);

            $this->responseJson(false, "Item removido da lista!", "alert-info", $tableItens);
        } catch (Exception $e) {
            $this->responseJson(false, "Erro ao remover o item!", "alert-danger");
        }
    }

    private function listaItens(): array
    {
        $listaItens = [];
        if ($this->session->has("listaItens")) {
            $listaItens = $this->session->get("listaItens");
        }
        return $listaItens;
    }

    public function finalizar(array $data): void
    {
        try {
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

            foreach ($this->session->get("listaItens") as $item) {
                $itemProduto = $item;

                $produto = ProdutoDAO::get($item->getProduto()->getId());

                $itemProduto->setProduto($produto);
                $itemProduto->setEntrada($entrada);
                $entrada->getListaItemProdutos()->add($itemProduto);
                $entrada->setValorTotal($entrada->getValorTotal() + $item->getValorTotal());

                $novoPreco = ($produto->getPrecoEntrada() > $itemProduto->getValorUnitario() ? $produto->getPrecoEntrada() : $itemProduto->getValorUnitario());
                $produto->setPrecoEntrada($novoPreco);
                $produto->setEstoque($itemProduto->getQuantidade() + $produto->getEstoque());
                ProdutoDAO::atualizar($produto);
            }
            EntradaDAO::salvar($entrada);
            $mensagem = ($entrada->getStatus() == "FINALIZADA" ? "Entrada finalizada com sucesso!" : "Entrada salva com sucesso!");
            setMessage($mensagem, "alert-success");
            redirect("/entrada/nova");
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
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

    public function teste(): void
    {
        // $this->finalizar();
    }
}
