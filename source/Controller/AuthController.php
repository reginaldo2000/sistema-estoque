<?php

namespace Source\Controller;

use Exception;
use Source\DAO\UsuarioDAO;

class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaLogin(): void
    {
        if (isset(session()->usuario)) {
            redirect("/dashboard");
        }
        $this->responseView("login/pagina-login", []);
    }

    public function autenticar(array $data): void
    {
        $usuario = $data["usuario"];
        $senha = md5($data["senha"]);
        try {
            $usuarioObj = UsuarioDAO::getUsuario($usuario, $senha);
            if (!$usuarioObj) {
                session_set("msgAlerta", "Usuário ou senha incorretos!");
                redirect("/");
            }
            session_set("usuario", $usuarioObj);
            redirect("/dashboard");
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }
}
