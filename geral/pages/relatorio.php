<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>

<?php 
	$paginaAtual = 'relatório';
	include('../includes/header.php');
?>

<?php
	// Inclui a página de conexão
	include('../conexao/dbcon.php');

	// Verifica se foi enviado um ano para filtrar a tabela
	if (isset($_POST['putAno'])) {
		$anoFiltro = $_POST['putAno'];
	} else {
		$anoFiltro = date('Y'); // Ano atual por padrão
	}
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <title>Fatec Parking</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
			  <link rel="stylesheet" type="text/css" href="../css/estiloRelatorio.css"> 
			  

</head>

<body>
	<div class="container text-center mt-3">
		<h1>Relatório</h1>
		<hr>

		<button
			type="button"
			class="btn btn-primary mb-3"
			data-bs-toggle="modal"
			data-bs-target="#filtraAno"
		>
			Filtrar Ano
		</button>

		<h2 class="mb-3">Valores arrecadados por mês - Ano <?php echo $anoFiltro; ?></h2>

		<div class="container mt-3">
			<div class="table-responsive">
				<table class="table align-middle text-center table-bordered table-hover border-dark-subtley table-striped">
					<thead class="table-dark">
						<tr>
							<th scope="col">Mês</th>
							<th scope="col">Carro</th>
							<th scope="col">Moto</th>
							<th scope="col">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$meses = array(
								1 => 'Janeiro',
								2 => 'Fevereiro',
								3 => 'Março',
								4 => 'Abril',
								5 => 'Maio',
								6 => 'Junho',
								7 => 'Julho',
								8 => 'Agosto',
								9 => 'Setembro',
								10 => 'Outubro',
								11 => 'Novembro',
								12 => 'Dezembro'
							);

							$totalCarroAno = 0;
							$totalMotoAno = 0;
							$totalMesAno = 0;

							for ($mes = 1; $mes <= 12; $mes++) {
								// Query: Obter o valor total arrecadado no mês para carros
								$queryCarro = "SELECT IFNULL(SUM(r.vl_Pagamento), 0) AS totalCarro 
									FROM registro r
									INNER JOIN veiculo v ON r.cd_Veiculo = v.cd_Veiculo
									WHERE MONTH(r.dt_Saida) = $mes AND YEAR(r.dt_Saida) = $anoFiltro AND r.dt_Saida IS NOT NULL AND v.cd_Tipo = '1'";
								$resultCarro = mysqli_query($conn, $queryCarro);
								$rowCarro = mysqli_fetch_assoc($resultCarro);
								$totalCarro = $rowCarro['totalCarro'];

								// Query: Obter o valor total arrecadado no mês para motos
								$queryMoto = "SELECT IFNULL(SUM(r.vl_Pagamento), 0) AS totalMoto 
									FROM registro r
									INNER JOIN veiculo v ON r.cd_Veiculo = v.cd_Veiculo
									WHERE MONTH(r.dt_Saida) = $mes AND YEAR(r.dt_Saida) = $anoFiltro AND r.dt_Saida IS NOT NULL AND v.cd_Tipo = '2'";
								$resultMoto = mysqli_query($conn, $queryMoto);
								$rowMoto = mysqli_fetch_assoc($resultMoto);
								$totalMoto = $rowMoto['totalMoto'];

								// Calcular o total arrecadado no mês
								$totalMes = $totalCarro + $totalMoto;

								echo "<tr>";
								echo "<td>" . $meses[$mes] . "</td>";
								echo "<td>" . ($totalCarro != 0 ? 'R$ ' . number_format($totalCarro, 2, ',', '.') : '-') . "</td>";
								echo "<td>" . ($totalMoto != 0 ? 'R$ ' . number_format($totalMoto, 2, ',', '.') : '-') . "</td>";
								echo "<td>" . ($totalMes != 0 ? 'R$ ' . number_format($totalMes, 2, ',', '.') : '-') . "</td>";
								echo "</tr>";

								// Atualizar os acumulados totais do ano
								$totalCarroAno += $totalCarro;
								$totalMotoAno += $totalMoto;
								$totalMesAno += $totalMes;

								// Se for o mês de dezembro, adiciona a linha com o acumulado do ano abaixo da última linha da tabela
								if ($mes == 12) {
									echo "<tr>";
									echo "<td class='fw-bold'>Acumulado do Ano</td>";
									echo "<td class='fw-bold'>" . ($totalCarroAno != 0 ? 'R$ ' . number_format($totalCarroAno, 2, ',', '.') : '-') . "</td>";
									echo "<td class='fw-bold'>" . ($totalMotoAno != 0 ? 'R$ ' . number_format($totalMotoAno, 2, ',', '.') : '-') . "</td>";
									echo "<td class='fw-bold'>" . ($totalMesAno != 0 ? 'R$ ' . number_format($totalMesAno, 2, ',', '.') : '-') . "</td>";
									echo "</tr>";
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- MODAL FILTRO DO ANO -->
		<div class="modal fade" id="filtraAno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="filtraAno">Filtrar ano do relatório</h5>
						<button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="POST" action="relatorio.php">
						<div class="modal-body">
							<div class="form-group col-md-6">
								<?php
									// Query para selecionar os anos dos veículos estacionados
									$query1 = "SELECT DISTINCT YEAR(dt_Entrada) AS ano FROM registro ORDER BY ano DESC";
									$result1 = mysqli_query($conn, $query1);

									echo "<label for='ano' class='form-label' id='ano'>Ano</label>";
									echo "<select class='form-control' name='putAno'>";
									echo "<option value='' disabled selected style='display: none'>Selecione o ano</option>";
									while ($row = mysqli_fetch_assoc($result1)) {
										echo "<option value='" . $row['ano'] . "'>" . $row['ano'] . "</option>";
									}
									echo "</select>";
								?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Filtrar</button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		
	</div>
</body>
</html>
