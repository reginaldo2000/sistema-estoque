<?php

namespace Source\Controller;

class ErroController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaErroPadrao(array $data): void
    {
        switch ($data["codigo"]) {
            case 400:
                $this->erro400();
                break;
            case 401:
                $this->erro401();
                break;
            case 403:
                $this->erro403();
                break;
            case 404:
                $this->erro404();
                break;
            case 500:
                $this->erro500();
                break;
            default:
                $this->erroPadrao($data["codigo"]);
        }
    }

    private function erro400(): void
    {
        $this->responseView("erro/pagina-erro", [
            "codigo" => 400,
            "mensagem" => "O sistema não pôde processar sua requisição!"
        ]);
    }

    private function erro401(): void
    {
        $this->responseView("erro/pagina-erro", [
            "codigo" => 401,
            "mensagem" => "Você precisa estar autenticado para acessar o sistema!"
        ]);
    }

    private function erro403(): void
    {
        $this->responseView("erro/pagina-erro", [
            "codigo" => 403,
            "mensagem" => "Você não possui acesso a essa página!"
        ]);
    }

    private function erro404(): void
    {
        $this->responseView("erro/pagina-erro", [
            "codigo" => 404,
            "mensagem" => "Página não encontrada!"
        ]);
    }

    private function erro500(): void
    {
        $this->responseView("erro/pagina-erro", [
            "codigo" => 500,
            "mensagem" => "Problema interno do sistema!"
        ]);
    }

    private function erroPadrao(int $codigo): void
    {
        $this->responseView("erro/pagina-erro", [
            "codigo" => $codigo,
            "mensagem" => "Algo inesperado aconteceu!"
        ]);
    }
}
