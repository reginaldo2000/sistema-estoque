<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Utils\Session;

/**
 * Description of Controller
 *
 * @author Reginaldo
 */
abstract class Controller
{

    private Engine $view;

    protected Session $session;

    public function __construct(string $path)
    {
        
        $this->view = new Engine($path);
        $this->session = new Session();
    }

    /**
     * @param bool $erro
     * @param string $message
     * @param string $messageType
     * @param string $render
     * @return void
     */
    public function responseJson(bool $erro, string $message = "", string $messageType = "alert-success", string $render = ""): void
    {
        $dados = [
            "error" => $erro,
            "message" => $message,
            "messageType" => $messageType,
            "render" => $render
        ];
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    }

    public function responseView(string $path, array $params): void
    {
        echo $this->view->render($path, $params);
    }

    public function renderView(string $path, array $params): string
    {
        return $this->view->render($path, $params);
    }

    public function verificaUsuarioAutenticado(): void
    {
        if (!$this->session->has("usuario")) {
            redirect("/");
        }
    }
}
