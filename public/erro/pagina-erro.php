<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops - Sistema de Estoque</title>
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/css/style.css"); ?>">
</head>

<body>
    <main class="erro">
        <h1 class="text-center">Oops!!!</h1>

        <h2 class="text-center"><?= $mensagem; ?></h2>

        <a href="<?= url("/"); ?>" class="botao_erro">
            Continuar Navegando
        </a>
    </main>
</body>

</html>