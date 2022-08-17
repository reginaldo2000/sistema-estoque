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

    public function responseJson(array $params): void
    {
        echo json_encode($params, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS);
        return;
    }

    public function responseView(string $path, array $params): void
    {
        echo $this->view->render($path, $params);
    }
}
