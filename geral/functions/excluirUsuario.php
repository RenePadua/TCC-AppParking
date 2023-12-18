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
		
		// Recebendo os dados escolhidos no menu em variáveis com valores preenchidos
		$putMail = $_POST['putMail'];
		
		// Query: Excluir o usuário da tabela 'users'
		$query_delete_usuario = "DELETE FROM users WHERE email = '$putMail'";
		$result_delete_usuario = mysqli_query($conn, $query_delete_usuario);
		
		// Verificar se a query foi executada com sucesso
		if ($result_delete_usuario) {
			// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Excluiu o usuário $putMail";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
				
			// Redireciona de volta para a página anterior com um parâmetro "sucesso" na URL
			header("Location: ../pages/usuarios.php?sucesso=1");
			exit();
		} else {
			// Erro na execução da query
			echo "Erro ao excluir o usuário: " . mysqli_error($conn);
		}
		
		// Fechar conexão com o banco de dados
		mysqli_close($conn);
	?>
  </body>
</html>
