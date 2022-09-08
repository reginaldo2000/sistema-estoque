<?php

namespace Source\Controller;

use Exception;
use Source\DAO\ProdutoDAO;
use Source\Entity\ItemProduto;

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
        // var_dump(session());
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
            if(isset(session()->listaItens)) {
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
            $listaItens = [];
            if (isset(session()->listaItens)) {
                $listaItens = (array) session()->listaItens;
            }

            $item = new ItemProduto();
            $item->setProduto(ProdutoDAO::get($data["produto_id"]));
            $item->setQuantidade(1.000);

            array_push($listaItens, serialize($item));
            session_set("listaItens", $listaItens);

            $render = $this->renderView("/entrada/_includes/table-itens-entrada", [
                "listaItens" => $listaItens,
                "index" => 1
            ]);

            $this->responseJson(false, "Deu certo!", "alert-info", $render);
        } catch (Exception $e) {
            $this->responseJson(true, "Não deu certo!", "alert-danger", $render);
        }
    }
}
