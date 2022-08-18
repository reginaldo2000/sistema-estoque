<?php

namespace Source\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
        $this->verificaUsuarioAutenticado();
    }

    public function paginaInicial(): void
    {
        $this->responseView("dashboard/pagina-inicial", [
            "nomePagina" => "Dashboard"
        ]);
    }
}
