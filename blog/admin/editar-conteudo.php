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
    $cont = Read('postagem', "where idpost = '{$id}' limit 1");

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
        <title>Editar Conteúdo | Painel de Administração</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="icon" href="https://content.lubnorteam.com.br/files/img/lubnorte.jpg">

        <script src="ckeditor/ckeditor.js"></script>

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
                <h1 class="display-3">Editar Conteúdo</h1>
                <p class="lead">Preencha os campos abaixo para continuar</p>
                <hr class="m-y-md">
            </div>		

            <?php
            if (isset($_POST['atualizar'])) {
                $form['titulo'] = Escape(strip_tags(trim($_POST['titulo'])));
                $form['descricao'] = Escape(strip_tags(trim($_POST['descricao'])));
                $form['autor'] = Escape(strip_tags(trim($_POST['autor'])));
                $form['data'] = date('Y-m-d H:i:s');
                $form['tipopostagem'] = Escape(strip_tags(trim($_POST['tipopostagem'])));
                $form['conteudo'] = str_replace('\r\n', " ", Escape(htmlspecialchars($_POST['conteudo'], ENT_QUOTES)));
                $form['visitas'] = 0;
                $form['statuspost'] = 1;

                $form = Escape($form);

                if (empty($form['titulo'])) {
                    echo "<script>alert('Favor, insira o título da notícia que será destacado na página principal');location='novo-conteudo.php';</script>";
                } else if (empty($form['descricao'])) {
                    echo "<script>alert('Favor, insira detalhes sobre a postagem. Eles serão exibidos na página principal');location='novo-conteudo.php';</script>";
                } else if (empty($form['autor'])) {
                    echo "<script>alert('Quem escreveu a notícia? Insira um autor da postagem.');location='novo-conteudo.php';</script>";
                } elseif (empty($form['tipopostagem'] || $form['tipopostagem'] == 0)) {
                    echo "<script>alert('Selecione a categoria de postagem');location='novo-conteudo.php';</script>";
                } else if (empty($form['conteudo'])) {
                    echo "<script>alert('Não há notícia sem notícia. Insira o conteúdo da notícia antes de continuar.');location='index.php';</script>";
                } else {
                    $dbCheck = Read('postagem', "WHERE titulo = '" . $form['titulo'] . "' and idpost != '{$id}' ");
                    if ($dbCheck) {
                        echo "
			<script>
			alert('Já existe uma postagem com esse nome. Tente novamente.');
			location = 'editar-conteudo.php?id=" . $cont['idpost'] . "';
			</script>
			";
                    } else {
                        if (Update('postagem', $form, " idpost = '{$id}'")) {
                            echo "
				<script>
				alert('Postagem atualizada com sucesso!.');
				window.close();
				</script>
				";
                        } else {
                            echo "
				<script>
				alert('Ocorreu um erro ao postar a notícia. Tente novamente e, em caso de persistencia do erro, contate o administrador do sistema.');
				window.close();
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
                                    <label for="titulo">Título do Conteúdo</label>
                                    <input type="text" name="titulo" class="form-control" placeholder="Dê um título para sua notícia" value="<?php echo stripslashes($cont['titulo']); ?>">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="descricao">Descrição do Conteúdo</label>
                                    <input type="text" class="form-control" placeholder="Resumo breve da notícia veiculada" name="descricao" value="<?php echo $cont['descricao']; ?>">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label for="categoria">Categoria do Conteúdo</label>
                                    <select id="inputCategoria" class="form-control" name="tipopostagem">
                                        <option value="Noticia">Notícia</option>
                                        <option value="Artigo">Artigo</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label for="autor">Autor</label>
                                    <input type="text" class="form-control" placeholder="Quem escreveu a notícia?" name="autor" value="<?php echo $cont['autor']; ?>">
                                </div>
                                <div class="form-group col-md-4 col-12">	
                                    <label for="data">Data</label>
                                    <input type="date" class="form-control" name="data" format="dd/mm/YYYY" value="<?php echo $cont['data']; ?>">	
                                </div>
                                <div class="form-group col-12">
                                    <label for="titulo">Conteúdo da Notícia</label>
                                    <textarea class="form-control" name="conteudo" id="conteudo" cols="50" rows="10" style="resize: none;"><?php echo $cont['conteudo']; ?></textarea>
                                    <script>
                                        CKEDITOR.replace('conteudo');
                                    </script>
                                </div>
                                <div class="form-group col-12 text-center">
                                    <br>
                                    <input type="submit" name="atualizar" value="Atualizar Conteúdo" class="btn btn-primary">
                                    <a href="" class="btn btn-success" onclick="window.close();">Fechar</a>
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