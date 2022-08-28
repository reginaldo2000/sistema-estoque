<?php

namespace Source\Utils;

class Paginacao
{

    private string $route;
    private int $pagina;
    private int $numeroLinhas;
    private int $totalResultados;
    private array $params;

    public function __construct(string $route, array $params, int $pagina = 1, int $numeroLinhas = 10)
    {
        $this->route = $route;
        $this->pagina = $pagina;
        $this->numeroLinhas = $numeroLinhas;
        $this->params = $params;
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

    public function escolherPagina(int $numeroPagina): string
    {
        return $this->route . "/" . $numeroPagina . "" . $this->getStringParams();
    }

    public function getPaginaAnterior(): string
    {
        return $this->pagina > 1 ? $this->route . "/" . ($this->pagina - 1) . $this->getStringParams() : "#";
    }

    public function getProximaPagina(): string
    {
        return $this->pagina < $this->getNumeroPaginas() ? $this->route . "/" . ($this->pagina + 1) . $this->getStringParams() : "#";
    }

    public function getTotalResultados(): int
    {
        return $this->totalResultados;
    }

    public function setTotalResultados(int $totalResultados)
    {
        $this->totalResultados = $totalResultados;
    }

    public function getNumeroPaginas(): int
    {
        $num = $this->totalResultados % $this->numeroLinhas;
        if ($num != 0) {
            return intval($this->totalResultados / $this->numeroLinhas) + 1;
        }
        return intval($this->totalResultados / $this->numeroLinhas);
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function getStringParams(): string
    {
        unset($this->params["route"]);
        $keys = array_keys($this->params);
        $string = "";
        foreach ($keys as $key) {
            if ($string == "") {
                $string .= "?" . $key . "=" . $this->params[$key];
            } else {
                $string .= "&" . $key . "=" . $this->params[$key];
            }
        }
        return $string;
    }
}
