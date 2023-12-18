<?php
ob_start();
session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: ../pages/login.php');
		exit;
	}
	
	include('newLog.php');
	
	// Obter o e-mail do usuário autenticado
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
		$putMail = $_POST['putMail'];
		$putNivel = $_POST['putNivel'];	
		
		// Query: Atualizar o nível de permissão do usuário na tabela 'users'
		$query_update_nivel = "UPDATE users SET cd_Nivel = '$putNivel' WHERE email = '$putMail'";
		$result_update_nivel = mysqli_query($conn, $query_update_nivel);
		
		
		$queryNivel = "SELECT nivel_Acesso from nivel_acesso where cd_Nivel = $putNivel";
		$resultNivel = mysqli_query($conn, $queryNivel);
		$row = mysqli_fetch_row($resultNivel);
		$nomeNivel = $row[0];
		
		
		// Verificar se a query foi executada com sucesso
		if ($result_update_nivel) {
			// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Alterou o nível de permissão de $putMail para: $nomeNivel";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
				mysqli_free_result($resultNivel);
				
			// Redireciona de volta para a página anterior com um parâmetro "sucesso" na URL
			header("Location: ../pages/usuarios.php?sucesso=1");
			exit();
		} else {
			// Erro na execução da query
			echo "Erro ao atualizar o nível de permissão: " . mysqli_error($conn);
		}
		
		// Fechar conexão com o banco de dados
		mysqli_close($conn);
	?>
