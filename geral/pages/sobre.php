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

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>App Parking</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/estiloSobre.css">
</head>

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