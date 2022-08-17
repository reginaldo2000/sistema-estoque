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

    public function paginaUsuario(array $data): void
    {
        $nomeUsuario = (filter_input(INPUT_GET, "pesquisa") ? filter_input(INPUT_GET, "pesquisa", FILTER_SANITIZE_SPECIAL_CHARS) : "");
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
                UsuarioDAO::atualizar($usuario);
                $this->responseJson(false, "Usuário atualizado com sucesso!", $this->renderTableUsuarios());
            }
        } catch (Exception $e) {
            $this->responseJson(true, $e->getMessage());
        }
    }

    public function getDadosUsuario(array $data): void
    {
        try {
            $id = $data["id"];
            $usuario = UsuarioDAO::getUsuarioById($id);
            echo json_encode($usuario->toArray(), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return;
        }
    }

    public function excluirUsuario(array $data): void
    {
        try {
            $id = $data["id"];
            $usuario = UsuarioDAO::getUsuarioById($id);
            if(empty($usuario)) {
                throw new Exception("Usuário não encontrado!", 400);
            }
            UsuarioDAO::excluir($usuario->getId());
            $this->responseJson(false, "Usuário excluído com sucesso!", $this->renderTableUsuarios());
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
