<?php

namespace Source\Controller;

use Exception;
use Source\DAO\ProdutoDAO;
use Source\Entity\ItemProduto;
use Source\Entity\Produto;


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
            $this->responseView("entrada/pagina-entrada", []);
        } catch (Exception $e) {
        }
    }

    public function paginaNovaEntrada(array $data): void
    {
        try {
            if (session_get("listaItens") != null) {
                session_remove("listaItens");
            }
            $listaProdutos = ProdutoDAO::listarProdutos();
            $this->responseView("entrada/pagina-nova-entrada", [
                "listaProdutos" => $listaProdutos,
                "listaItens" => []
            ]);
        } catch (Exception $e) {
        }
    }

    public function addItem(array $data): void
    {
        try {
            $item = new ItemProduto();
            $item->setProduto($this->retornaProduto($data));
            $item->setQuantidade(1.000);

            $listaItens = [];
            if (session_get("listaItens") != null) {
                $listaItens = session_get("listaItens");
            }

            array_push($listaItens, serialize($item));
            session_set("listaItens", $listaItens);

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
        if (session_get("listaItens") != null) {
            $listaItens = session_get("listaItens");
        }

        $listaIds = [];
        foreach ($listaItens as $obj) {
            $item = unserialize($obj);
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
        $listaItens = [];
        if (session_get("listaItens") != null) {
            $listaItens = session_get("listaItens");
        }

        $novaListaItens = [];
        foreach($listaItens as $item) {
            $novoItem = unserialize($item);

            $idProduto = $novoItem->getProduto()->getId();
            $novoItem->setQuantidade(formataParaFloat($data[$idProduto."_quantidade"]));
            $novoItem->getProduto()->setPrecoEntrada(formataParaFloat($data[$idProduto."_valor_unitario"]));

            array_push($novaListaItens, serialize($novoItem));
        }

        $tableItens = $this->renderView("/entrada/_includes/table-itens-entrada", [
            "listaItens" => $novaListaItens,
            "index" => 1
        ]);

        $this->responseJson(false, "Valores recalculados com sucesso!", "alert-info", $tableItens);
    }
}
