<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}

	$paginaAtual = 'pico';
	include('../includes/header.php'); 

	// Inclui a página de conexão
	include('../conexao/dbcon.php');


// Definir valores padrão para os horários de início e fim
$horarioInicio = '08';
$horarioFim = '21';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os valores dos campos de entrada
    $horarioInicio = $_POST['inicio'];
    $horarioFim = $_POST['fim'];
}

	
// Defina os horários padrão se os campos estiverem vazios
if(empty($horarioInicio)) {
    $horarioInicio = '08:00';
}

if(empty($horarioFim)) {
    $horarioFim = '21:00';
}

// Função para obter as horas de pico com base nos horários fornecidos pelo usuário
function getHorariosPico($conn, $horarioInicio, $horarioFim)
{
    $sql = "SELECT HOUR(dt_Entrada) as hora_entrada, COUNT(*) as quantidade FROM registro
            WHERE HOUR(dt_Entrada) >= '$horarioInicio' AND HOUR(dt_Entrada) <= '$horarioFim'
            GROUP BY HOUR(dt_Entrada) ORDER BY COUNT(*) DESC LIMIT 5";
    
    $result = $conn->query($sql);

    $horarios_pico = array();
    while ($row = $result->fetch_assoc()) {
        $horarios_pico[] = $row['hora_entrada'] . ":00";
    }
    return $horarios_pico;
}

// Obter as horas de pico atualizadas com base nos horários fornecidos pelo usuário
$horarios_pico = getHorariosPico($conn, $horarioInicio, $horarioFim);


	// Código PHP para obter as cinco horas cheias com maior taxa de pico
	$sql_horas_pico = "SELECT HOUR(dt_Entrada) as hora_pico, COUNT(*) as quantidade FROM registro
            WHERE TIME(dt_Entrada) >= '$horarioInicio:00' AND TIME(dt_Entrada) <= '$horarioFim:00'
            GROUP BY HOUR(dt_Entrada) ORDER BY COUNT(*) DESC LIMIT 5";
	$result_horas_pico = $conn->query($sql_horas_pico);
	$horas_cheias_comuns = array();

	while ($row_horas_pico = $result_horas_pico->fetch_assoc()) {
		$horas_cheias_comuns[$row_horas_pico['hora_pico']] = $row_horas_pico['quantidade'];
	}

	// Ordena o array em ordem crescente pelas chaves (horas)
	ksort($horas_cheias_comuns);


	// Criar um novo array com as horas de pico em ordem crescente e a quantidade de veículos correspondente
	$horas_pico_crescente = array();
	foreach ($horas_cheias_comuns as $hora => $quantidade) {
		$horas_pico_crescente[] = $hora;
	}

	// Cria um novo array com as quantidades correspondentes na ordem crescente de horas
	$quantidades_crescente = array_values($horas_cheias_comuns);
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Pico de Veículos Estacionados</title>
		<link rel="stylesheet" type="text/css" href="../css/estiloPico.css"> 
	</head>
	<body>
	<div class="container mt-4 text-center">
		<div class="container">
		<h1>Horários de Pico</h1>
		<hr>
			</div>
		</div>
		
		<!-- Gráfico com os horários de pico -->
		<div class="mt-4">
			<div class="col-md-6 offset-md-3">
				<canvas id="myChart"></canvas>
			</div>
		</div>
		<div class="mt-3 text-center">
			<?php echo "<legend>***Pico de veículos estacionados por horário no período de funcionamento das " . $horarioInicio . "h às " . $horarioFim . "h.</legend>";?>
		</div>
		
	</div>

	<!-- Biblioteca Chart.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	
<div class"text-center">
	<div class="card mt-3 mx-auto bg-dark text-light" style="max-width: 310px;">
		<div class="container bg-gray text-center">
			<form method='POST'>
				<label>DAS
					<input type='number' name='inicio' title='inicio' min='0' max='23' value='<?php echo htmlspecialchars($horarioInicio); ?>'>h
				</label>
				<label>ÀS
					<input type='number' name='fim' title='fim' min='0' max='23' value='<?php echo htmlspecialchars($horarioFim); ?>'>h
				</label>
				<button type='submit' class='btn btn-success btn-sm'>Editar</button>
			</form>
		</div>
	</div>
</div>

	
	
	<script>
		// Função para obter os horários de pico do servidor
		function getHorariosPico() {
			$.ajax({
				url: 'pico.php', // Arquivo PHP que retorna os horários de pico
				type: 'GET',
				dataType: 'json',
				success: function (data) {
					// Atualizar os labels do gráfico com os horários de pico mais comuns
					myChart.data.labels = data;
					myChart.update();
				},
				error: function (xhr, status, error) {
					console.error('Erro na requisição AJAX: ' + status + ' ' + error);
				}
			});
		}

		// Encontra o valor máximo do volume de veículos
		var maxVolume = Math.max.apply(Math, <?php echo json_encode($quantidades_crescente); ?>);

		// Código JavaScript para criar o gráfico
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($horas_pico_crescente); ?>.map(function(hora) {
            return hora + 'h'; // Adicione 'h' ao final de cada hora
        }),
				datasets: [{
					label: 'Número de Veículos Estacionados',
					data: <?php echo json_encode($quantidades_crescente); ?>,
					backgroundColor: ['blue', 'green', 'orange', 'purple', 'darksalmon'],
					borderColor: ['blue', 'green', 'orange', 'purple', 'darksalmon'],
					maxBarThickness: 35,
					minBarLength: 20,
					borderWidth: 1
				}]
			},
			options: {
				  legend: {display: false},
						
				scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
			}
		});

	</script>
	</body>
	</html>