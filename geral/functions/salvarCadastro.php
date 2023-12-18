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
  </head>
  
  <body> 
	<?php
		// Verificação de erros na conexão
		if (!$conn) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		// Transformando os dados escolhidos no menu em variáveis com valores preenchidos
		$putPlaca = $_POST['putPlaca'];
		$putVeiculo = $_POST['putVeiculo'];
		$putMarca = $_POST['putMarca'];
		$putModelo = $_POST['putModelo'];
		$putCor = $_POST['putCor'];
		
		// Query 1: Verificar se a placa já existe na tabela 'veiculo'
		$query_check_placa = "SELECT * FROM veiculo WHERE cd_Placa = '$putPlaca'";
		$result_check_placa = mysqli_query($conn, $query_check_placa);
		
		if (mysqli_num_rows($result_check_placa) > 0) {
			// Placa já existe na tabela
			echo '<script>alert("A placa informada já está cadastrada."); window.location.href = "../pages/cadastro.php";</script>';
			exit();
		}
		
		// Query 2: Inserir um novo registro na tabela 'veiculo'
		$query_insert_veiculo = "INSERT INTO veiculo (cd_Placa, cd_Tipo, cd_Marca, nm_Modelo, nm_Cor) VALUES ('$putPlaca', '$putVeiculo', '$putMarca', '$putModelo', '$putCor')";
		$result_insert_veiculo = mysqli_query($conn, $query_insert_veiculo);
		
		// Verificar se a segunda query foi executada com sucesso
		if ($result_insert_veiculo) {
			// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Cadastrou o veículo de placa: $putPlaca";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
			// Redireciona de volta para a página anterior com um parâmetro "sucesso" na URL
			header("Location: ../pages/cadastro.php?sucesso=1");
			exit();
		} else {
			// Erro na execução da query
			echo "Erro ao cadastrar veículo: " . mysqli_error($conn);
		}
		
		// Fechar conexão com o banco de dados
		mysqli_close($conn);
	?>
  </body>
</html>