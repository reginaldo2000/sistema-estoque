<?php

namespace Source\Controller;

use League\Plates\Engine;

/**
 * Description of Controller
 *
 * @author Reginaldo
 */
abstract class Controller
{

    private Engine $view;

    public function __construct(string $path)
    {
        $this->view = new Engine($path);
    }

    public function responseJson(bool $erro, string $message = "", string $render = ""): void
    {
        $dados = [
            "erro" => $erro,
            "message" => $message,
            "render" => $render
        ];
        echo json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS);
        return;
    }

    public function responseView(string $path, array $params): void
    {
        echo $this->view->render($path, $params);
    }

    public function renderView(string $path, array $params): string {
        return $this->view->render($path, $params);
    }
}
