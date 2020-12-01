<?php

require_once '../../system/controller/controller.php';
require_once '../../system/model/dbconnect.php';

session_start();

$form['usuario'] = Escape(strip_tags(trim($_POST['usuario'])));
$form['senha'] = Escape(strip_tags(trim($_POST['senha'])));

$form = Escape($form);

$dbCheck = Read('usuarios',"WHERE usuario ='".$form['usuario']."' AND senha = '".$form['senha']."' AND statususuario = 1");

if($dbCheck){
	$_SESSION['usuario'] = $form['usuario'];
	$_SESSION['senha'] = $form['senha'];
	
	echo "
		<script>
			alert('Bem vindo!');
			window.location = '../index.php';
		</script>
	";
}else{
	unset ($_SESSION['usuario']);
	unset ($_SESSION['senha']);
	
	echo "
		<script>
			alert('Erro ao acessar sistemas. Tente novamente.');
			window.location= '../login.php';
		</script>
	";
}