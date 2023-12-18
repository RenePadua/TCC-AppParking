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

	// Inclui a página de conexão
	include('../conexao/dbcon.php');

	// Verificação de erros na conexão
	if (!$conn) {
		die("Conexão falhou: " . mysqli_connect_error());
	}

	// Transformando os dados escolhidos no menu em variáveis com valores preenchidos
	$putMail = $_POST['putMail'];
	$putSenha = $_POST['putSenha'];
	$putConfirmarSenha = $_POST['putConfirmarSenha'];

	// Verificar se a senha e a confirmação da senha são idênticas
	if ($putSenha !== $putConfirmarSenha) {
		echo '<script>alert("As senhas informadas não coincidem."); window.location.href = "../pages/usuarios.php";</script>';
		exit();
	}

	// Cria o hash da senha usando password_hash() com o algoritmo bcrypt
	$senha_hash = password_hash($putSenha, PASSWORD_BCRYPT);

	// Query: Atualizar a senha do usuário na tabela 'users'
	$query_update_senha = "UPDATE users SET senha_hash = '$senha_hash' WHERE email = '$putMail'";
	$result_update_senha = mysqli_query($conn, $query_update_senha);

	// Verificar se a query foi executada com sucesso
	if ($result_update_senha) {
		// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Alterou a senha do usuário $putMail";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
				
		// Redireciona de volta para a página anterior com um parâmetro "sucesso" na URL
		header("Location: ../pages/usuarios.php?sucesso=1");
		exit();
	} else {
		// Erro na execução da query
		echo "Erro ao atualizar a senha do usuário: " . mysqli_error($conn);
	}

	// Fechar conexão com o banco de dados
	mysqli_close($conn);
?>
