<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>

<?php 
	$paginaAtual = 'home';
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
	<div class="container text-center mt-3">
		<h1>App Parking</h1>
		<div class="container">
			<img class="img-fluid my-3" style="width: 400px; height: auto; border: solid 2px #000; border-radius: 25px;" src="../img/homeParking.jpg">
			<!-- //https://www.lexisnexis.co.uk/blog/images/default-source/purpose-built/18984275_l.jpg?sfvrsn=d55ba77f_2 -->
		</div>

		<?php
			// Query: Selecionar todos as marcas de veículo
			$query = "SELECT tipo.nm_Tipo AS tipoVeiculo, 
			COUNT(registro.cd_Veiculo) AS veiculoEstacionado,
			vagas.vagas AS vagasExistentes
				FROM registro
				INNER JOIN veiculo ON registro.cd_Veiculo = veiculo.cd_Veiculo
				INNER JOIN tipo ON veiculo.cd_Tipo = tipo.cd_Tipo
				INNER JOIN vagas ON tipo.cd_Tipo = vagas.tipo_id
				WHERE registro.dt_Saida IS NULL
				GROUP BY tipo.nm_Tipo;";
			$result = mysqli_query($conn, $query);
			
			$alertaVagas = ''; // Inicializa a variável para o alerta de vagas disponíveis

			// Exibir a quantidade de veículos estacionados e vagas disponíveis
			while ($row = mysqli_fetch_assoc($result)) {
				$veiculosEstacionados = $row['veiculoEstacionado'];
				$tipoVeiculo = $row['tipoVeiculo'];

				// Verificar se o número de vagas está a uma vaga para alcançar a lotação
				$vagasExistentes = $row['vagasExistentes'];
				$lotacaoMaxima = $veiculosEstacionados + 1; // Número de vagas para alcançar a lotação

				// Exibe um alerta caso a lotação máxima esteja próxima
				if ($vagasExistentes == $lotacaoMaxima) {
					$alertaVagas .= "<div class='container text-center mt-3'>";
					$alertaVagas .= "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
					$alertaVagas .= "ATENÇÃO: Resta apenas 01 vaga disponível para $tipoVeiculo! Observar a disponibilidade de vagas reservadas por lei!";
					$alertaVagas .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
					$alertaVagas .= "</div>";
					$alertaVagas .= "</div>";
				}
			}
		?>

		<!-- Mostra o alerta de vagas disponíveis antes de exibir a quantidade de veículos estacionados -->
		<?php echo $alertaVagas; ?>

		<div class="card mt-3 mb-3 bg-dark border-warning" style="max-width: 400px; margin: auto;">
			<div class="container mb-3 bg-gray text-center" style="max-width: 350px">
				<div class="mt-2">
					<h3 class="text-light">
						Veículos estacionados agora
					</h3>

					<?php
					// Exibir a quantidade de veículos estacionados e vagas disponíveis
					echo "<div class='bg-black p-1 m-auto mt-3 border border-light rounded'>";
					$result = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_assoc($result)) {
						$veiculosEstacionados = $row['veiculoEstacionado'];
						$tipoVeiculo = $row['tipoVeiculo'];

						echo "<p class='text-light align-middle m-2'>" . $tipoVeiculo . " : " . $veiculosEstacionados . " estacionado(s)</p>";
					}
					echo "</div>";
					?>
				</div>

				<h3 class="text-light mt-3">
					Vagas disponíveis
				</h3>
				<?php
				// Exibir a quantidade de veículos estacionados e vagas disponíveis
				echo "<div class='bg-black p-1 m-auto mt-3 border border-light rounded'>";
				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_assoc($result)) {
					$veiculosEstacionados = $row['veiculoEstacionado'];
					$vagasExistentes = $row['vagasExistentes'];
					$vagasDisponiveis = $vagasExistentes - $veiculosEstacionados;
					$tipoVeiculo = $row['tipoVeiculo'];

					echo "<p class='text-light align-middle m-2'>" . $tipoVeiculo . ": " . $vagasDisponiveis . " vaga(s)</p>";
				}
				echo "</div>";
				?>
			</div>
		</div>
	</div>

	<?php
	// Fechar conexão com o banco de dados
	mysqli_close($conn);
	?>
</body>
</html>
