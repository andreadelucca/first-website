<?php 

session_start();

unset($_SESSION['usuario']);
unset($_SESSION['senha']);

session_destroy();

echo "
	<script>
         alert('Usuário desconectado com sucesso! Até mais');
         window.close();
	</script>

";