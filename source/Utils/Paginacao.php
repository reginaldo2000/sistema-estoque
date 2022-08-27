<?php

namespace Source\Utils;

class Paginacao
{

    private string $route;
    private int $pagina;
    private int $numeroLinhas;

    public function __construct(string $route, int $pagina = 1, int $numeroLinhas = 10)
    {
        $this->route = $route;
        $this->pagina = $pagina;
        $this->numeroLinhas = $numeroLinhas;
    }

    public function getPagina(): int
    {
        return $this->pagina;
    }

    public function getNumeroLinhas(): int
    {
        return $this->numeroLinhas;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getProximaPagina(): int {
        return $this->pagina + 1;
    }
}
