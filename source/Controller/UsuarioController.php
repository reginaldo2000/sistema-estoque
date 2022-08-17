<?php

namespace Source\Controller;

use DateTime;
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

    public function salvar(array $data): void
    {
        try {
            $usuario = new Usuario();

            $usuario->setUsuario($data["usuario"]);
            $usuario->setSenha(md5($data["senha"]));
            $usuario->setNomeUsuario($data["nome_usuario"]);
            $usuario->setStatus($data["status"]);
            $usuario->setDataModificacao(new DateTime());

            if ($data["id"] == "") {
                $usuario->setDataCriacao(new DateTime());
                UsuarioDAO::salvar($usuario);
                $this->responseJson(false, "Usuário cadastrado com sucesso!", $this->renderTableUsuarios());
            } else {
                $usuario->setId($data["id"]);
                $usuario->setDataModificacao(new DateTime());
            }
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage());
        }
    }

    private function renderTableUsuarios(): string
    {
        try {
            $listaUsuarios = UsuarioDAO::listaUsuarios("");
            return $this->renderView("usuario/_includes/_table-usuarios", [
                "listaUsuarios" => $listaUsuarios
            ]);
        } catch (Exception $e) {
            return "";
        }
    }
}
