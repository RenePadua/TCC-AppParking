<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>

<?php 
	$paginaAtual = 'logs';
	include('../includes/header.php');
?>	
	
	
<?php
// Inclui a página de conexão
include('../conexao/dbcon.php');

?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fatec Parking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/estiloLogs.css">
</head>

<body> 
<div class="container text-center mt-3">
  <h1>Histórico de Logs</h1>
  <hr>
  
  <div class="table-responsive mt-4"">
    <table class="table align-middle text-center table-bordered table-hover border-dark-subtley table-striped">
      <thead class="table-dark">
        <tr>
          <!--
		  <th scope="col">#</th>
          <th scope="col">Cód. Veículo</th>
		  -->
          <th scope="col">Id</th>
          <th scope="col">Data e Hora</th>
          <th scope="col">Usuário</th>
          <th scope="col">Ação realizada</th>
        </tr>
      </thead>
      <tbody>
	  
	<?php
	      $query = "SELECT * FROM logs_movimentacao order by id DESC";
		  $result = mysqli_query($conn, $query);
	?>
	  
	  
	  
	  
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<th scope='row'>" . $row['id'] . "</th>";
			// Recebe o valor do Banco
            $dataLog = $row['data_hora'];
            // Formata o valor para data/hora BR
            $dataLogFormatada = date('d/m/Y - H:i:s', strtotime($dataLog));
            echo "<td>" . $dataLogFormatada . "</td>";
			echo "<td>" . $row['usuario_email'] . "</td>";
            echo "<td>" . $row['acao_realizada'] . "</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>  

<?php
    // Feche a conexão com o banco de dados
    mysqli_close($conn);
?>

</body>
</html>