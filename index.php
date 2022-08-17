<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(MAIN_URL);

$route->namespace("Source\Controller");
$route->get("/", "UsuarioController:paginaLogin");
$route->get("/dashboard", "HomeController:paginaInicial");

$route->namespace("Source\Controller")->group("usuario");
$route->get("/lista", "UsuarioController:paginaUsuario");
$route->get("/dados-usuario/{id}", "UsuarioController:getDadosUsuario");

$route->post("/autenticar", "UsuarioController:autenticar");
$route->post("/salvar", "UsuarioController:salvar");

/**
 * Rotas de tratamento de erros
 */
$route->group("oops")->namespace("Source\Controller");
$route->get("/{codigo}", "ErroController:paginaErroPadrao");

$route->dispatch();

if ($route->error()) {
    $route->redirect("/oops/{$route->error()}");
}