<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
	include('../functions/newLog.php');
	
	// Obter o email do usuário autenticado
	$emailUsuario = $_SESSION['email'];
?>

<?php
      $paginaAtual = 'vagas';
      include('../includes/header.php');
?>

<?php
	// Inclui a página de conexão
	include('../conexao/dbcon.php');
?>

<?php
// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Iterar sobre os dados enviados via POST para atualizar as vagas de cada tipo de veículo
	foreach ($_POST as $key => $value) {
		// Verifica se a chave começa com "vagas_" e se o valor é um número
		if (strpos($key, 'vagas_') === 0 && is_numeric($value)) {
			// Extrai o ID do tipo de veículo a partir da chave
			$tipo_id = substr($key, strlen('vagas_'));
			$novoValor = (int)$value;

			// Obter a quantidade de veículos estacionados desse tipo
			$queryVeiculosEstacionados = "SELECT COUNT(*) AS veiculosEstacionados FROM registro 
										  INNER JOIN veiculo ON registro.cd_Veiculo = veiculo.cd_Veiculo 
										  WHERE veiculo.cd_Tipo = $tipo_id AND registro.dt_Saida IS NULL";
			$resultVeiculosEstacionados = mysqli_query($conn, $queryVeiculosEstacionados);
			$rowVeiculosEstacionados = mysqli_fetch_assoc($resultVeiculosEstacionados);
			$veiculosEstacionados = $rowVeiculosEstacionados['veiculosEstacionados'];

			// Verificar se o novo valor de vagas é maior ou igual ao número de veículos estacionados
			if ($novoValor >= $veiculosEstacionados) {
				// Atualizar o número de vagas para o tipo de veículo correspondente
				$query = "UPDATE vagas SET vagas = $novoValor WHERE tipo_id = $tipo_id";
				$result = mysqli_query($conn, $query);

				// Obter o nome do tipo de veículo para registrar na mensagem de log
				$queryTipo = "SELECT nm_Tipo FROM tipo WHERE cd_Tipo = $tipo_id";
				$resultTipo = mysqli_query($conn, $queryTipo);
				$rowTipo = mysqli_fetch_assoc($resultTipo);
				$nomeTipo = $rowTipo['nm_Tipo'];

				// Verificar se a atualização foi realizada com sucesso
				if ($result) {
					// Registrar a movimentação na tabela de logs
					$acaoRealizada = "Alterou o número de vagas de $nomeTipo para: $novoValor";
					registrarLogMovimentacao($emailUsuario, $acaoRealizada);

					// Liberar o resultado da consulta
					mysqli_free_result($resultTipo);

					// Exibir uma mensagem de sucesso após a atualização
					echo '<script>alert("Vagas atualizadas com sucesso.");</script>';
				}
			} else {
				// O novo valor de vagas é menor que o número de veículos estacionados
				echo '<script>alert("A quantidade de vagas não pode ser menor que a quantidade de veículos estacionados.");</script>';
			}
			
			// Liberar o resultado da consulta
			mysqli_free_result($resultVeiculosEstacionados);
		}
	}
}


// Consultar os valores na tabela "vagas"
$queryVagas = "SELECT * FROM vagas";
$resultVagas = mysqli_query($conn, $queryVagas);
$vagasVeiculos = array();

while ($rowVagas = mysqli_fetch_assoc($resultVagas)) {
	$vagasVeiculos[$rowVagas['tipo_id']] = $rowVagas['vagas'];
}
?>

<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fatec Parking</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estiloVagas.css"> 
	

</head>
<body>
	<div class="container text-center mt-3">
		<h1 class="mt-3">Vagas</h1>
		<hr>
		<div class="card mt-3 mx-auto bg-dark" style="max-width: 400px;">
			<div class="container mt-3 bg-gray text-center" style="max-width: 350px">
				<div class="table-responsive">
					<table class="table align-middle text-center table-bordered border-dark-subtley text-light">

							<?php
							// Consulta os valores na tabela "vagas" para obter o número de vagas de cada veículo
							$queryVagas = "SELECT tipo.nm_Tipo, vagas.vagas, vagas.tipo_id FROM tipo LEFT JOIN vagas ON tipo.cd_Tipo = vagas.tipo_id";
							$resultVagas = mysqli_query($conn, $queryVagas);

							while ($rowVagas = mysqli_fetch_assoc($resultVagas)) {
								echo "<tr>";
								echo "<td>
											<form method='POST'>
												<input type='hidden' name='tipo_id' value='" . $rowVagas['tipo_id'] . "'>
												<label>" . $rowVagas['nm_Tipo'] . "
													<input type='number' name='vagas_" . $rowVagas['tipo_id'] . "' value='" . $rowVagas['vagas'] . "' title='Quantidade de vagas'>
												</label>
												<button type='submit' class='btn btn-success'>Editar</button>
											</form>

										</td>";
								echo "</tr>";
							}
							?>				
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
	// Feche a conexão com o banco de dados
	mysqli_close($conn);
	?>
</body>
</html>
