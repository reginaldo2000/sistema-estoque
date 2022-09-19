<?php

ob_start();

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Utils\Session;

$session = new Session();

$route = new Router(MAIN_URL);

$route->namespace("Source\Controller");
$route->get("/", "AuthController:paginaLogin");
$route->get("/sair", "AuthController:sair");
$route->get("/dashboard", "HomeController:paginaInicial");


$route->namespace("Source\Controller")->group("usuario");
$route->get("/lista", "UsuarioController:paginaUsuario");
$route->get("/dados-usuario/{id}", "UsuarioController:getDadosUsuario");
$route->post("/autenticar", "AuthController:autenticar");
$route->post("/salvar", "UsuarioController:salvar");
$route->delete("/excluir", "UsuarioController:excluirUsuario");


$route->namespace("Source\Controller")->group("produto");
$route->get("/lista", "ProdutoController:paginaProdutos");
$route->get("/lista/{pagina}", "ProdutoController:paginaProdutos");
$route->get("/novo", "ProdutoController:paginaNovoProduto");
$route->post("/salvar", "ProdutoController:salvar");
$route->get("/editar/{id}", "ProdutoController:paginaEditarProduto");
$route->put("/atualizar/{id}", "ProdutoController:salvar");
$route->get("/visualizar/{id}", "ProdutoController:visualizar");
$route->get("/dados-produto/{id}", "ProdutoController:getProduto");
$route->delete("/excluir", "ProdutoController:excluir");


$route->namespace("Source\Controller")->group("entrada");
$route->get("/lista", "EntradaController:paginaEntrada");
$route->get("/nova", "EntradaController:paginaNovaEntrada");
$route->get("/editar/{id}", "EntradaController:paginaNovaEntrada");
$route->post("/add-item", "EntradaController:addItem");
$route->post("/atualizar-valores", "EntradaController:atualizarValores");
$route->get("/atualiza-tabela-produtos", "EntradaController:tabelaProdutos");
$route->delete("/remover-item/{index}", "EntradaController:removerItem");
$route->post("/finalizar", "EntradaController:finalizar");
$route->post("/salvar-continuar/{descricao}/{codigo_nota}/{status}", "EntradaController:finalizar");
$route->get("/visualizar/{id}", "EntradaController:visualizar");

$route->get("/teste", "EntradaController:teste");


$route->namespace("Source\Controller")->group("categoria");
$route->get("/lista", "CategoriaController:paginaCategoria");
$route->get("/lista/{pagina}", "CategoriaController:paginaCategoria");
$route->post("/salvar", "CategoriaController:salvar");
$route->get("/dados-categoria/{id}", "CategoriaController:getCategoria");
$route->post("/excluir", "CategoriaController:excluir");


/**
 * Rotas de tratamento de erros
 */
$route->group("oops")->namespace("Source\Controller");
$route->get("/{codigo}", "ErroController:paginaErroPadrao");

$route->dispatch();

if ($route->error()) {
    $route->redirect("/oops/{$route->error()}");
}

ob_flush();