<?php
require_once './system/controller/controller.php';
require_once './system/model/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Início | Blog LUBNORTE</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="https://content.lubnorteam.com.br/css/style.min.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <!-- Blog Custom CSS -->
        <link rel="stylesheet" href="https://content.lubnorteam.com.br/css/blog.min.css">

        <!-- Jumbotron Video -->
        <link rel="stylesheet" href="https://content.lubnorteam.com.br/css/jumbotron-video.min.css">

        <!-- Icon Site -->
        <link rel="icon" href="https://content.lubnorteam.com.br/files/img/lubnorte.jpg">

        <!-- Font Awesome JS -->
        <script src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>

    </head>
    <body>

        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="sidebar-header">
                    <h3><a href="index.php">Início</a></h3>
                </div>
                <ul class="list-unstyled components">
                    <hr>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Artigos</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="artigos.php">Todos os artigos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Notícias</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="noticias.php">Todas as notícias</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="admin/login.php" target="_blank">Área do Administrador</a>
                    </li>
                    <li>
                        <a href="https://lubnorteam.com.br/#contact" target="_blank">Contato</a>
                    </li>
                </ul>
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="" onclick="window.close();" class="download">Sair do Blog</a>
                    </li>
                    <li>
                        <a href="mailto:projetodigital@gmail.com?Subject='Site LUBNORTE - Contato com o Desenvolvedor'" class="article">Contatar o Desenvolvedor</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">

                <div class="container">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button type="button" id="sidebarCollapse" class="btn btn-danger">
                                <i class="fas fa-align-left"></i>
                                <span>Menu</span>
                            </button>
                            <img src="https://content.lubnorteam.com.br/files/img/lubnorte.jpg" alt="lub-logo" width="50" height="50">
                        </div>
                    </nav>


                    <div class="jumbotron jumbotron-fluid">
                        <div class="container text-white">
                            <h1 class="display-4">Sejam bem-vindos ao Blog da LUBNORTE</h1>
                            <p class="lead text-white">Aqui você estará por dentro de nossos casos de sucesso, acompanha todas as nossas novidades e fica por dentro do que a LUBNORTE pode lhe oferecer de melhor!</p>
                            <hr class="my-4">
                            <p class="text-justify text-white">Clique sobre o título de uma notícia ou artigo e saiba mais</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <?php
                            $materias = Read('postagem', 'where statuspost = 1 order by idpost desc');
                            if (!$materias) {
                                echo 'Nada a exibir. Volte mais tarde para mais novidades.';
                            } else {
                                foreach ($materias as $materia) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="blog-post">
                                            <h3 class="text-justify"><a href="materia.php?id=<?php echo $materia['idpost']; ?>"><?php echo stripslashes($materia['titulo']); ?></a></h3>
                                            <h6 class="text-justify">Em "<?php echo $materia['tipopostagem']; ?>"</h6>
                                            <p class="text-justify"><?php echo $materia['descricao']; ?></p>
                                        </div>
                                        <hr>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>   
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <aside class="col-md-12 blog-sidebar">
                                    <div class="p-3 mb-3 bg-light rounded">
                                        <h4 class="font-italic">Sobre o Blog</h4>
                                        <p class="mb-0 text-justify">Este blog foi idealizado visando citar nossos casos de sucesso em empresas parceiras. Todo conteúdo aqui é descrito com simplicidade para todos os nossos colaboradores e clientes.</p>
                                    </div>

                                    <div class="p-3">
                                        <h4>Nos siga em nossas redes sociais</h4>
                                        <ol class="list-unstyled">
                                            <li><a href="#">Instagram</a></li>
                                            <li><a href="#">Twitter</a></li>
                                            <li><a href="#">Facebook</a></li>
                                        </ol>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>

                    <main role="main" class="container">    

                    </main>

                    <footer class="blog-footer">
                        <p class="text-center">Criado pela <a href="mailto:projetodigital@gmail.com?Subject='Site Lubnorte'">Projeto Digital</a>, com bibliotecas CSS cedidas por <a href='https://heybootstrap.com/' target="_blank">Bootstrapious</a> e <a href="https://getbootstrap.com.br" target="_blank">Bootstrap</a>.</p>
                        <p class="text-center">
                            <a href="#">Voltar ao topo</a>
                        </p>
                    </footer>

                </div>

            </div>

        </div>

        <div class="overlay"></div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#sidebar").mCustomScrollbar({
                                    theme: "minimal"
                                });

                                $('#dismiss, .overlay').on('click', function () {
                                    $('#sidebar').removeClass('active');
                                    $('.overlay').removeClass('active');
                                });

                                $('#sidebarCollapse').on('click', function () {
                                    $('#sidebar').addClass('active');
                                    $('.overlay').addClass('active');
                                    $('.collapse.in').toggleClass('in');
                                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                                });
                            });
        </script>
    </body>
</html>