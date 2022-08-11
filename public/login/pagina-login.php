<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Estoque</title>
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/css/style.css"); ?>">
</head>

<body>
    <main>
        <section class="login">

            <img src="<?= asset("/images/logo_login.jpg"); ?>" alt="logo do sistema de estoque">

            <div class="login_body">

                <?= (isset(session()->msgAlerta) ? session()->msgAlerta : ""); ?>
                
                <form method="POST" action="<?= url("/usuario/autenticar"); ?>" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="usuario">Usuário:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-success w-100">
                                Entrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </main>
</body>

</html>