<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>
	 	
<?php 
	$paginaAtual = 'sobre';
	include('../includes/header.php'); 
?>


  <body>
    <div class="container text-center mt-3">
	<h1>#Projeto App Parking</h1>
	<hr>

	<h2>Integrantes:</h2>

	<h3>Renê Silva Amorim de Pádua</h3>
	<p>RA - 0050831921023</p>
	<h3>Thaís Barbosa da Silva</h3>
	<p>RA - 0050831921028</p>

</div>

  </body>
</html>