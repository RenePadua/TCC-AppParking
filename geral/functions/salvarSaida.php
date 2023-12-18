<?php
ob_start();
session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: ../pages/login.php');
		exit;
	}
	
	include('newLog.php');
	
	// Obter o email do usuário autenticado
	$emailUsuario = $_SESSION['email'];
?>

<?php
	$paginaAtual = 'saída';
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
    <title>App Parking</title>
	<link rel="stylesheet" type="text/css" href="../css/estiloSaidaFinal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
 
    <?php



    // Verificação de erros na conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }



    // Validação e escape dos dados recebidos do formulário
	$putCodigo = $_POST['putCodigo'];
	$putPlaca = $_POST['putPlaca'];
	$putTipo = $_POST['putTipo'];
	$putMarca = $_POST['putMarca'];
	$putModelo = $_POST['putModelo'];
	$putCor = $_POST['putCor'];
	$putEntrada = $_POST['putEntrada'];
	$putPermanencia = $_POST['putPermanencia'];
    $putSaida = mysqli_real_escape_string($conn, $_POST['putSaida']);
    $putValor = mysqli_real_escape_string($conn, $_POST['putValor']);
	$putValor30min = mysqli_real_escape_string($conn, $_POST['putValor30min']);
	$putValor1hora = mysqli_real_escape_string($conn, $_POST['putValor1hora']);
	$putValor2horas = mysqli_real_escape_string($conn, $_POST['putValor2horas']);
	$putValorDemaisHoras = mysqli_real_escape_string($conn, $_POST['putValorDemaisHoras']);
	

    // Query: Atualizar registro de saída na tabela 'Registro'
    $query = "UPDATE registro SET dt_Saida = '$putSaida', vl_Pagamento = '$putValor' WHERE cd_Registro = '$putCodigo'";


    $result = mysqli_query($conn, $query);

    if ($result) {
        // Saída registrada com sucesso
		// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Registrou saída de placa: $putPlaca - Valores(30 min: $putValor30min, 1h: $putValor1hora, 2h: $putValor2horas e demais: $putValorDemaisHoras)";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
				
        echo '<div class="container mt-3">';
			echo '<div id="etc">';
			echo '<h3 class="text-center">Saída do estacionamento registrada com sucesso!</h3>';
			echo '<div class="text-center">';
				echo '<img class="mt-3" style="width: 150px; height: 150px;" src="../img/sucesso.png" alt="Imagem de Sucesso">';
				//https://pixabay.com/pt/vectors/%C3%ADcone-s%C3%ADmbolo-confirma%C3%A7%C3%A3o-gancho-803718/
				echo '<div class="mt-3">
					<button id="btnImprimir" class="btn btn-warning">Imprimir</button>
				</div>';
			echo '<div>';
		echo '<a href="../pages/index.php" class="btn btn-primary text-center mt-3">Voltar</a>';
        
		echo '</div>';
			echo '</div>';
				echo '</div>';
		
		echo '<div id="recibo" style="max-width: 25rem; margin: auto;">'; 
            echo '<div class="card align-items-center">';
		
		
			echo '<div class="card-body">';

		echo '<div id="imprimirRecibo" class="text-center">
				<h2>App Parking</h2>
				<h3>Recibo</h3>
				<h3>--------------------------</h3>';
			 
		 	
		                // Exibe os dados do recibo na Impressão

                          echo "<p class='card-text m-1'><span class='fw-bold'>Placa do Veículo: </span>" . $putPlaca . "</p>";
						  echo "<p class='card-text m-1'><span class='fw-bold'>Tipo de Veículo: </span>" . $putTipo . "</p>";
						  echo "<p class='card-text m-1'><span class='fw-bold'>Marca: </span>" . $putMarca . "</p>";
						  echo "<p class='card-text m-1'><span class='fw-bold'>Modelo: </span>" . $putModelo . "</p>";
						  echo "<p class='card-text m-1'><span class='fw-bold'>Cor: </span>" . $putCor . "</p>";
						  echo "<p class='card-text m-1'><span class='fw-bold'>Data de Entrada: </span>" . $putEntrada . "</p>";
						  
						  $putSaida = date('Y-m-d H:i:s');
                          $saidaFormatada = date('d/m/Y H:i:s', strtotime($putSaida));
						  echo "<p class='card-text m-1'><span class='fw-bold'>Data de Saída: </span>" . $saidaFormatada . "</p>";
						  
						  echo "<p class='card-text m-1'><span class='fw-bold'>Permanência: </span>" . $putPermanencia . "</p>";
	  
						  echo "<ul>";
						  echo "<li class='card-text m-1'><span class='fw-bold'>Referência - 30 minutos: </span>" . $putValor30min . "</li>";
						  echo "<li class='card-text m-1'><span class='fw-bold'>Referência - 01 hora: </span>" . $putValor1hora . "</li>";
						  echo "<li class='card-text m-1'><span class='fw-bold'>Referência - 02 horas: </span>" . $putValor2horas . "</li>";
						  echo "<li class='card-text m-1'><span class='fw-bold'>Referência - Demais horas: </span>" . $putValorDemaisHoras . "</li>";
						  echo "</ul>";
						  // Formatar o valor calculado para versão monetária
							$valorPagoFormatado = 'R$ ' . number_format($putValor, 2, ',', '.');
						  
							echo "<p id='valorPago' class='card-text m-1'><span class='fw-bold'>Valor Total Pago: </span>" . $valorPagoFormatado . "</p>";
		
		 echo '</div>';
		echo '</div>';		
		echo '</div>';	
		echo '</div>';
		
		
		echo '</div>';
    } else {
        // Ocorreu um erro ao inserir o registro
        echo '<div class="container mt-3 text-center">';
        echo '<h3>Erro</h3>';
        echo '<p>Ocorreu um erro ao registrar a saída do estacionamento.</p>';
        echo '</div>';
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conn);
    ?>
	
	
<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("btnImprimir").addEventListener("click", function () {
                window.print();
            });
        });
</script>	

</body>
</html>