<?php
session_start();

if ((!isset($_SESSION['usuario']) == true) and ( !isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    echo "
      <script>
        alert('Você não está logado no sistema. Faça login para começar');
        window.location = 'login.php';
      </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="Painel de Administração LUBNORTE">
        <meta name="author" content="André Batista">
        <title>Início | Painel de Administração</title>
        <link rel="stylesheet" href="https://content.lubnorteam.com.br/css/bootstrap.min.css">

        <link rel="icon" href="https://content.lubnorteam.com.br/files/img/lubnorte.jpg">
    </head>
    <body>

        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-sm-center" id="navbarMain">
                <ul class="navbar-nav">
                    <li class="nav-item active ">
                        <h3><a class="nav-link" href="#" style="color: #ffffff;">Painel de Administração LUBNORTE <span class="sr-only">(current)</span></a></h3>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">

            <br>

            <div class="jumbotron">
                <h1 class="display-3">Bem vindo, Usuário</h1>
                <p class="lead">Escolha uma das seções abaixo para iniciar</p>
                <hr class="m-y-md">
            </div>		

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="container">
                            <br>
                            <div class="card-block">
                                <h4 class="card-title"><a href="novo-conteudo.php">Novo Conteúdo</a></h4>
                                <p class="card-text">Clique para adicionar um novo artigo ou notícia ao Blog</p>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="container">
                            <br>
                            <div class="card-block">
                                <h4 class="card-title"><a href="listar-conteudo.php">Listar e Editar Conteúdos Publicados</a></h4>
                                <p class="card-text">Clique aqui para listar os conteúdos já publicados no Blog</p>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="col-md-12 col-12 text-center">
                <a class="btn btn-primary" href="logoff.php">Sair do Sistema</a>
            </div>
            <br><br>

        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>