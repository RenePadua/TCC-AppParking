<?php
session_start();
require 'dbcon.php';
?>



<!doctype html>
<html lang="pt-br">
  
<head>
  <title>Minha aplicação</title>
</head>
<body>

<?php include('header.php'); ?>



<div id="conteudo">
  <?php
    if(isset($_GET['pagina'])){
      $pagina = $_GET['pagina'];
      if($pagina == 'about'){
        include('about.php');
      } else {
        include('home.php');
      }
    } else {
      include('home.php');
    }
  ?>
</div>

	
	
  </body>
</html>