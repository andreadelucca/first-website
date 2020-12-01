<?php
require_once '../system/controller/controller.php';
require_once '../system/model/dbconnect.php';

 session_start();

  if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
  {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    echo "
      <script>
        alert('Você não está logado no sistema. Faça login para começar');
        window.location = 'login.php';
      </script>
    ";
  }

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
} else {
    $id = Escape(strip_tags(trim($_GET['id'])));
    $cont = Read('usuarios', "where idusuario = '{$id}' limit 1");

    if (!$cont) {
        echo "<script>
		alert('Não foi possível completar sua solicitação. O dado informado não existe.');
		window.close();
            </script>";
    } else {
        $cont = $cont[0];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Adicionar novo conteúdo">
        <meta name="author" content="André Batista">
        <title>Novo Conteúdo | Painel de Administração</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
                <h1 class="display-3">Novo Usuário</h1>
                <p class="lead">Preencha os campos abaixo para continuar</p>
                <hr class="m-y-md">
            </div>

            <?php
            if (isset($_POST['atualizar'])) {
                $form['nome'] = Escape(strip_tags(trim($_POST['nome'])));
                $form['usuario'] = Escape(strip_tags(trim($_POST['usuario'])));
                $form['senha'] = Escape(strip_tags(trim($_POST['senha'])));
                $form['statususuario'] = '1';
                
                $form = Escape($form);

                if (empty($form['nome'])) {
                    echo "<script>alert('Favor, insira o nome.');location='novo-usuario.php';</script>";
                } else if (empty($form['usuario'])) {
                    echo "<script>alert('Favor, insira o nome de usuário (login)');location='novo-usuario.php';</script>";
                } else if (empty($form['senha'])) {
                    echo "<script>alert('Insira a senha de usuário para acesso aos sistema');location='novo-usuario.php';</script>";
                } elseif($form['senha'] != $_POST['senha2']){
                    echo "<script>alert('Senhas digitadas não conferem! Tente novamente');location='novo-usuario.php';</script>";
                } else if(empty($_POST['senha2'])){
                    echo "<script>alert('Repita a senha antes de prosseguir! Tente novamente');location='novo-usuario.php';</script>";
                } else {
                    $dbCheck = Read('usuarios', "WHERE usuario = '" . $form['usuario'] . "' and idusuario != '{$id}' ");
                    if ($dbCheck) {
                        echo "
			<script>
			alert('Já existe um usuário com esse nome. Tente novamente.');
			location = 'editar-usuario.php?id=" . $cont['idusuario'] . "';
			</script>
			";
                    } else {
                        if (Update('usuarios', $form, " idusuario = '{$id}'")) {
                            echo "
				<script>
				alert('Usuário alterado no sistema com sucesso! Para barrar o acesso do usuário, desative-o em Gerenciar Usuários');
				location = 'index.php';
				</script>
				";
                        } else {
                            echo "
				<script>
				alert('Ocorreu um erro ao requisitar a solicitação. Tente novamente e, em caso de persistencia do erro, contate o desenvolvedor do sistema.');
				location = 'index.php';
				</script>
				";
                        }
                    }
                }
            }
            ?>

            <form action="" method="post">

                <div class="container">
                    <form action="" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label for="usuario">Nome</label>
                                    <input type="text" class="form-control" placeholder="Nome do usuário" name="nome" value="<?php echo $cont['nome']; ?>">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="usuario">Login de usuário</label>
                                    <input type="text" class="form-control" placeholder="Nome que aparecerá como de usuário do Sistema ao logar" name="usuario" value="<?php echo $cont['usuario']; ?>">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="senha1">Senha</label>
                                    <input type="password" class="form-control" placeholder="Digite aqui a senha" name="senha" value="<?php echo $cont['senha']; ?>">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="senha2">Repita a Senha</label>
                                    <input type="password" class="form-control" placeholder="Digite novamente a senha" name="senha2" value="<?php echo $cont['senha']; ?>">
                                </div>
                                <div class="form-group col-12 text-center">
                                    <br>
                                    <input type="submit" name="atualizar" value="Atualizar Usuário" class="btn btn-primary">
                                    <a href="index.php" class="btn btn-success" onclick="window.close();">Fechar</a>
                                    <br><br>
                                </div>
                            </div>
                        </div>

                </div>

            </form>

        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>