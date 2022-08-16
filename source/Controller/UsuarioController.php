<?php

namespace Source\Controller;

use Exception;
use Source\DAO\UsuarioDAO;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Usuario;

/**
 * Description of UsuarioController
 *
 * @author Reginaldo
 */
class UsuarioController extends Controller
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

    public function paginaUsuario(array $data): void
    {
        $nomeUsuario = (filter_input(INPUT_GET, "nome_usuario") ? filter_input(INPUT_GET, "nome_usuario", FILTER_SANITIZE_SPECIAL_CHARS) : "");
        try {
            $listaUsuarios = UsuarioDAO::listaUsuarios($nomeUsuario);
            $this->responseView("usuario/pagina-usuario", [
                "nomePagina" => "Lista de Usuários",
                "listaUsuarios" => $listaUsuarios
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
