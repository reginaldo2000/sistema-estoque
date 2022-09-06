<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= NOME_PROJETO; ?></title>
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css.map"); ?>">
    <link rel="stylesheet" href="<?= asset("/css/style.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/ajax-form/ajax-form.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/font-awesome-4.7.0/css/font-awesome.min.css"); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
</head>

<body class="fundo_app">
    <header class="header_principal">
        <h1>Sistema de Estoque</h1>
    </header>

    <nav class="menu_principal">
        <ul>
            <li>
                <a href="<?= url("/dashboard"); ?>" class="icon-dashboard <?= ($nomePagina == "Dashboard" ? "active-menu" : ""); ?>">Dashboard</a>
            </li>
            <li>
                <a href="<?= url("/usuario/lista"); ?>" class="icon-usuarios <?= ($nomePagina == "Lista de Usuários" ? "active-menu" : ""); ?>">Usuários</a>
            </li>
            <li>
                <a href="<?= url("/categoria/lista"); ?>" class="icon-categorias <?= ($nomePagina == "Lista de Categorias" ? "active-menu" : ""); ?>">Categorias</a>
            </li>
            <li>
                <a href="<?= url("/produto/lista"); ?>" class="icon-produtos <?= ($nomePagina == "Lista de Produtos" ? "active-menu" : ""); ?>">Produtos</a>
            </li>
            <li>
                <a href="<?= url("/entrada/lista"); ?>" class="icon-entradas <?= ($nomePagina == "Registrar Entrada" ? "active-menu" : ""); ?>">Entradas</a>
            </li>
            <li>
                <a href="#" class="icon-saidas">Saídas</a>
            </li>
            <li>
                <a href="#" class="icon-estoque">Estoque</a>
            </li>
            <li>
                <a href="<?= url("/sair"); ?>" class="icon-sair">Sair</a>
            </li>
        </ul>
    </nav>

    <main class="conteudo_principal">
        <header class="header">
            <h2><?= $nomePagina; ?></h2>
        </header>

        <section class="conteudo">
            <?= $this->section("content"); ?>
        </section>
    </main>

    <div id="ajaxFormLoading" hidden>
        <div class="ajax-form-fundo-loading"></div>
        <div class="ajax-form-fundo-modal">
            <div class="ajax-form-loading"></div>
        </div>
    </div>

    <script src="<?= asset("/js/jquery-3.6.0.js"); ?>"></script>
    <script src="<?= url("/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?= asset("/js/main.js"); ?>"></script>
    <script src="<?= asset("/ajax-form/ajax-form.js"); ?>"></script>
    <script src="<?= asset("/js/funcoes.js"); ?>"></script>
    
    <?= $this->section("scripts"); ?>
</body>

</html>