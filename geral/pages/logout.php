<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}

	session_destroy();
	header('Location: login.php');
	exit;
?>
