<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= NOME_PROJETO; ?></title>
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/css/style.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/font-awesome-4.7.0/css/font-awesome.min.css"); ?>">
</head>

<body class="fundo_app">
    <header class="header_principal">
        <h1>Sistema de Estoque</h1>
    </header>

    <nav class="menu_principal">
        <ul>
            <li>
                <a href="#"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
            </li>
            <li>
                <a href="<?= url("/usuario/lista"); ?>"><i class="fa fa-users"></i> &nbsp;Usuários</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-tablet"></i> &nbsp;Produtos</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-plus-square"></i> &nbsp;Entradas</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-minus-square"></i> &nbsp;Saídas</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cubes"></i> &nbsp;Estoque</a>
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

</body>

</html>