<?php
require_once './system/controller/controller.php';
require_once './system/model/dbconnect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
} else {
    $id = Escape(strip_tags(trim($_GET['id'])));
    $post = Read('postagem', "where idpost = '{$id}' limit 1");

    if ($post) {
        $post = $post[0];
        $upVisitas = array(
            'visitas' => $post['visitas'] + 1
        );
        Update('postagem', $upVisitas, "idpost = '{$id}'");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $post['titulo']; ?> | Blog LUBNORTE</title>

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

                    <h1 class="text-center"><?php echo stripslashes($post['titulo']); ?></h1>
                    <br>
                    <h5 class="text-center"><?php echo $post['descricao']; ?></h5>
                    <br>
                    <h6 class="text-center"><i>Por <?php echo $post['autor']; ?>, em <?php echo date('d/m/Y', strtotime($post['data'])); ?></i></h6>

                    <hr>

                    <div class="col-md-12">
                        <?php 
                            get_magic_quotes_gpc();
                            $conteudopostagem = htmlspecialchars_decode($post['conteudo']);
                            echo $conteudopostagem;
                        ?>
                    </div>
                    
                    <br><br>
                    
                    <hr>
                    
                    <div class="col-md-12">
                        <h3>Comentários</h3>
                    </div>
                    
                    <div id="disqus_thread"></div>
                    <script>
                    
                    (function() {
                    var d = document, s = d.createElement('script');
                    s.src = 'https://blog-lubnorteam-com-br.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

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
        
        <script id="dsq-count-scr" src="//blog-lubnorteam-com-br.disqus.com/count.js" async></script>

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