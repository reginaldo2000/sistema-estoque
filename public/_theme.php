<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= NOME_PROJETO; ?></title>
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/css/style.css"); ?>">
</head>

<body class="fundo_app">
    <header class="header_principal">
        <h1>Sistema de Estoque</h1>
    </header>

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