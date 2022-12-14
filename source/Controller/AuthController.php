<?php

namespace Source\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Source\DAO\BootDAO;
use Source\DAO\UnidadeMedidaDAO;
use Source\DAO\UsuarioDAO;
use Source\Entity\UnidadeMedida;
use Source\Entity\Usuario;

class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function paginaLogin(): void
    {
        // $usuario = new Usuario();
        // $usuario->setUsuario("admin");
        // $usuario->setSenha(md5("admin"));
        // $usuario->setNomeUsuario("Administrador");
        // UsuarioDAO::salvar($usuario);
        
        if ($this->session->has("usuario")) {
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
                setMessage("Usuário ou senha incorretos!", "alert-warning");
                redirect("/");
            }
            $this->session->set("usuario", $usuarioObj);
            $this->boot();
            redirect("/dashboard");
        } catch (Exception $e) {
            redirect("/oops/{$e->getCode()}");
        }
    }

    public function sair(): void
    {
        session_destroy();
        redirect("/");
    }

    private function boot(): void
    {
        $this->preencheUnidadeMedidas();
    }

    private function preencheUnidadeMedidas(): void
    {
        $lista = UnidadeMedidaDAO::listar();
        if(!empty($lista)) {
            return;
        }

        $listaUnidadesMedida = new ArrayCollection();
        $unidadeMedida = new UnidadeMedida();
        $unidadeMedida->setNome("UN");

        $unidadeMedida2 = new UnidadeMedida();
        $unidadeMedida2->setNome("KG");

        $listaUnidadesMedida->add($unidadeMedida);
        $listaUnidadesMedida->add($unidadeMedida2);

        BootDAO::criarUnidadesDeMedida($listaUnidadesMedida);
    }
}
