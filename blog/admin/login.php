<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Página de Login">
        <meta name="author" content="André Batista">
        <link rel="icon" href="https://content.lubnorteam.com.br/files/img/lubnorte.jpg">

        <title>Acesso aos Sistemas Internos | Blog LUBNORTE</title>

        <!-- Principal CSS do Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Estilos customizados para esse template -->
        <link href="https://content.lubnorteam.com.br/css/signin.min.css" rel="stylesheet">
    </head>

    <body class="text-center">
        <form class="form-signin" action="security/auth.php" method="post">
            <img class="mb-4" src="https://content.lubnorteam.com.br/files/img/lubnorte.jpg" alt="lub-logo" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Login nos Sistemas Internos</h1>
            <br>
            <label for="inputUser" class="sr-only">Usuário</label>
            <input type="text" id="inputUser" class="form-control" placeholder="Seu nome de usuário" required autofocus name="usuario">
            <br>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required name="senha">
            <br><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <a class="btn btn-lg btn-danger btn-block" href="" onclick="window.close();">Fechar</a>
            <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?> Departamento de T.I. - LUBNORTE Equipamentos de Lubrificaçao LTDA.</p>
        </form>
    </body>
</html>
