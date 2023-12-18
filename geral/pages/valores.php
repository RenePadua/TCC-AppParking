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
$paginaAtual = 'valores';
include('../includes/header.php');
?>

<?php
// Inclui a página de conexão
include('../conexao/dbcon.php');
?>

<?php

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegando o novo valor
    $tipoVeiculo = $_POST['tipo_veiculo'];

	$campo = ''; // Inicialize a variável $campo
	
	    // Pegando os valores dos campos individualmente
    $vl30m = $_POST['valor_30_minutos_' . $tipoVeiculo];
    $vl01h = $_POST['valor_1_hora_' . $tipoVeiculo];
    $vl02h = $_POST['valor_2_horas_' . $tipoVeiculo];
    $vlDmh = $_POST['valor_demais_horas_' . $tipoVeiculo];

		// Verifique qual botão "Editar" foi pressionado
	if (isset($_POST['editar_30_minutos_' . $tipoVeiculo])) {
		$campo = 'vl_30_minutos';
		$valorAlterado = $vl30m;
	} elseif (isset($_POST['editar_1_hora_' . $tipoVeiculo])) {
		$campo = 'vl_1_hora';
		$valorAlterado = $vl01h;
	} elseif (isset($_POST['editar_2_horas_' . $tipoVeiculo])) {
		$campo = 'vl_2_horas';
		$valorAlterado = $vl02h;
	} elseif (isset($_POST['editar_demais_horas_' . $tipoVeiculo])) {
		$campo = 'vl_demais_horas';
		$valorAlterado = $vlDmh;
	};


	function formatarValorAlterado($valorAlterado){
		// Remova a formatação de moeda do valor editado
		$valorAlterado = str_replace('R$ ', '', $valorAlterado);
		$valorAlterado = str_replace('.', '', $valorAlterado);
		$valorAlterado = str_replace(',', '.', $valorAlterado);
		return $valorAlterado;
	}

	$valorSemFormatacao = formatarValorAlterado($valorAlterado);


	// Atualize o valor na tabela "tipo" apenas para o campo correspondente
	$query = "UPDATE tipo SET $campo = '$valorSemFormatacao' WHERE cd_Tipo = $tipoVeiculo";

 

    $result = mysqli_query($conn, $query);

    $queryTipo = "SELECT nm_Tipo from tipo where cd_Tipo = $tipoVeiculo";
    $resultTipo = mysqli_query($conn, $queryTipo);
    $row = mysqli_fetch_row($resultTipo);
    $nomeTipo = $row[0];


	if ($campo === 'vl_30_minutos') {
		$colunaAlterada = '30 minutos';
	} elseif ($campo === 'vl_1_hora') {
		$colunaAlterada = '01 Hora';
	} elseif ($campo === 'vl_2_horas') {
		$colunaAlterada = '02 Horas';
	} elseif ($campo === 'vl_demais_horas') {
		$colunaAlterada = 'Demais Horas';
	}


    // Alerta em caso de sucesso
    if ($result) {
        // Registrar a movimentação na tabela de logs
        $acaoRealizada = "Alterou o valor de $colunaAlterada de $nomeTipo para $valorAlterado";
        registrarLogMovimentacao($emailUsuario, $acaoRealizada);
        mysqli_free_result($resultTipo);
        // Exiba uma mensagem de sucesso
        echo '<script>alert("Valor atualizado com sucesso.");</script>';
    } else {
        // Exiba uma mensagem de erro caso ocorra um problema na atualização
        echo '<script>alert("Erro ao atualizar o valor. Por favor, tente novamente.");</script>';
    }
}

// Consulta os valores na tabela "tipo"
$query = "SELECT * FROM tipo";
$result = mysqli_query($conn, $query);


?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fatec Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estiloValores.css">

</head>

<body>
    <div class="container text-center mt-3">
        <h1 class="mt-3">Valores</h1>
        <hr>
  
        <div class="card mt-3 mx-auto bg-dark" style="max-width: 400px;">
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="container mt-3 bg-gray text-center" style="max-width: 380px">
               <div class="table-responsive">
                  <table class="table align-middle text-center table-bordered border-dark-subtley text-light">
                  <h3 class="text-light">' . $row["nm_Tipo"] . '</h3>
                     <thead>
                        <tr>
                           <th scope="col">Valor</th>
                        </tr>
                     </thead>
                     <tbody>';

            $valorVeiculo30min = $row['vl_30_minutos'];
            // Formata o valor calculado para versão monetária
            $valorVeiculoFormatado30min = 'R$ ' . number_format($valorVeiculo30min, 2, ',', '.');

            $valorVeiculo1hora = $row['vl_1_hora'];
            // Formata o valor calculado para versão monetária
            $valorVeiculoFormatado1hora = 'R$ ' . number_format($valorVeiculo1hora, 2, ',', '.');

            $valorVeiculo2horas = $row['vl_2_horas'];
            // Formata o valor calculado para versão monetária
            $valorVeiculoFormatado2horas = 'R$ ' . number_format($valorVeiculo2horas, 2, ',', '.');

            $valorVeiculoDemaisHoras = $row['vl_demais_horas'];
            // Formata o valor calculado para versão monetária
            $valorVeiculoFormatadoDemaisHoras = 'R$ ' . number_format($valorVeiculoDemaisHoras, 2, ',', '.');

            echo "<form method='POST'>
                            <input type='hidden' name='tipo_veiculo' value='" . $row['cd_Tipo'] . "'>";
            echo "<tr>
                                    <td>
                                        <label>30 Minutos</label>
                                        <input type='text' name='valor_30_minutos_" . $row['cd_Tipo'] . "' value='" . $valorVeiculoFormatado30min . "' title='O formato deve ser R$ X,XX'>
										<button type='submit' name='editar_30_minutos_" . $row['cd_Tipo'] . "' class='btn btn-success'>Editar</button>
                                    </td>                               
                                </tr>";
            echo "<tr>
                                    <td>
                                        <label>01 Hora</label>
                                        <input type='text' name='valor_1_hora_" . $row['cd_Tipo'] . "' value='" . $valorVeiculoFormatado1hora . "' title='O formato deve ser R$ X,XX'>
										<button type='submit' name='editar_1_hora_" . $row['cd_Tipo'] . "' class='btn btn-success'>Editar</button>
                                    </td>                               
                                </tr>";
            echo "<tr>
                                    <td>
                                        <label>02 Horas</label>
                                        <input type='text' name='valor_2_horas_" . $row['cd_Tipo'] . "' value='" . $valorVeiculoFormatado2horas . "' title='O formato deve ser R$ X,XX'>
										<button type='submit' name='editar_2_horas_" . $row['cd_Tipo'] . "' class='btn btn-success'>Editar</button>
                                    </td>                               
                                </tr>";
            echo "<tr>
                                    <td>
                                        <label>Demais Horas</label>
                                        <input type='text' name='valor_demais_horas_" . $row['cd_Tipo'] . "' value='" . $valorVeiculoFormatadoDemaisHoras . "' title='O formato deve ser R$ X,XX'>
										<button type='submit' name='editar_demais_horas_" . $row['cd_Tipo'] . "' class='btn btn-success'>Editar</button>
                                    </td>                               
                                </tr>
                            </form>";
        }
        ?>
                    </tbody>
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
