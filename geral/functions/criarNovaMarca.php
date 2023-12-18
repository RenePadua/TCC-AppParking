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

	<?php
		// Verificação de erros na conexão
		if (!$conn) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		// Transformando os dados escolhidos no menu em variáveis com valores preenchidos
		$putMarca = $_POST['putMarca'];
		
		// Query 1: Verificar se a marca já existe na tabela 'marca'
			$query_check_marca = "SELECT * FROM marca WHERE nm_Marca = '$putMarca'";
			$result_check_marca = mysqli_query($conn, $query_check_marca);

			if (mysqli_num_rows($result_check_marca) > 0) {
				// Marca já existe na tabela
				echo '<script>alert("A marca de veículo já existe."); window.location.href = "../pages/marcas.php";</script>';
				exit();
			}

			// Query 2: Inserir um novo registro na tabela 'marca'
			$query_insert_marca = "INSERT INTO marca (nm_Marca) VALUES ('$putMarca')";
			$result_insert_marca = mysqli_query($conn, $query_insert_marca);

			// Verificar se a segunda query foi executada com sucesso
			if ($result_insert_marca) {
				// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Criou uma nova marca: $putMarca";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
			
				
				// Redireciona de volta para a página anterior com um parâmetro "sucesso" na URL
				header("Location: ../pages/marcas.php?sucesso=1");
				exit();
			} else {
				// Erro na execução da query
				echo "Erro ao criar marca: " . mysqli_error($conn);
			}
		
		
		// Fechar conexão com o banco de dados
		mysqli_close($conn);
	?>
