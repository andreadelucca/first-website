<?php
require_once '../system/controller/controller.php';
require_once '../system/model/dbconnect.php';

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

if (isset($_GET['action-post']) && isset($_GET['id']) && !empty($_GET['action-post']) && !empty($_GET['id'])) {
    $id = Escape(strip_tags(trim($_GET['id'])));
    switch ($_GET['action-post']) {
        case 1:
            Update('usuarios', array('statususuario' => 0), "idusuario = '{$id}'");
            break;
        case 2:
            Update('usuarios', array('statususuario' => 1), "idusuario = '{$id}'");
            break;
    }
    header('Location: listar-usuario.php');
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
        <title>Listagem de Conteúdos Postados | Painel de Administração</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://content.lubnorteam.com.br/css/bootstrap.min.css">

        <!-- DataTables Plugins -->
        <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

        <link rel="icon" href="https://content.lubnorteam.com.br/files/img/lubnorte.jpg">

        <script>
            $(document).ready(function () {
                $('table.display').DataTable(
                        {
                            "lengthMenu": [[5, -1], [5, "Todos"]],
                            "bJQueryUI": true,
                            "oLanguage": {
                                "sProcessing": "Processando...",
                                "sLengthMenu": "Mostrar _MENU_ registros por página",
                                "sZeroRecords": "Não foram encontrados resultados. Tente novamente",
                                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                "sInfoEmpty": "Nenhum registro para ser listado. Insira novas informações e depois volte",
                                "sInfoFiltered": "",
                                "sInfoPostFix": "",
                                "sSearch": "Procurar nos registros:",
                                "sUrl": "",
                                "oPaginate": {
                                    "sFirst": "Primeiro",
                                    "sPrevious": "Anterior",
                                    "sNext": "Seguinte",
                                    "sLast": "Último"
                                }
                            }
                        }
                );
            });
        </script>

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
                <h1 class="display-3">Listar Usuários no Sistema</h1>
                <p class="lead">Selecione os conteúdos que serão alterados, em caso de atualização de informações. Observe que, nenhum usuario será excluído. Apenas desativado no sistema.</p>
                <hr class="m-y-md">
            </div>

            <table id="" class="display table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>ID Usuário</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Senha</th>
                        <th>Status de Usuário</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conteudo = Read('usuarios', 'order by idusuario desc');
                    if (!$conteudo) {
                        
                    } else {
                        foreach ($conteudo as $cont) {
                            ?>
                            <tr>
                                <td><?php echo $cont['idusuario']; ?></td>
                                <td>
                                    <?php echo $cont['nome']; ?>
                                </td>
                                <td><?php echo $cont['usuario']; ?></td>
                                <td>***********</td>
                                <?php
                                if ($cont['statususuario'] == 1) {
                                    echo "<td>Ativo</td>";
                                } else if ($cont['statususuario'] == 0) {
                                    echo "<td>Inativo</td>";
                                }
                                ?>
                                <td>
                                    <a href="editar-usuario.php?id=<?php echo $cont['idusuario']; ?>" target="_blank" class="btn btn-primary">Editar</a>
                                    <?php
                                    if ($cont['statususuario'] == 1) {
                                        ?>
                                        <a href="?action-post=1&&id=<?php echo $cont['idusuario']; ?>" class="btn btn-danger">Desativar</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="?action-post=2&&id=<?php echo $cont['idusuario']; ?>" class="btn btn-success">Ativar</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                        }
                        ?>
                    </tr>
                </tbody>
            </table>

            <br>

            <div class="col-md-12 text-center">
                <a href="index.php" class="btn btn-success">Voltar ao Início</a>
                <br><br><br><br>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>