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
		$putMail = $_POST['putMail'];
		$putSenha = $_POST['putSenha'];
		$putConfirmarSenha = $_POST['putConfirmarSenha']; // Adicionando a variável para a confirmação da senha
		$putNivel = $_POST['putNivel'];
		
		// Verificar se a senha e a confirmação da senha são idênticas
		if ($putSenha !== $putConfirmarSenha) {
			echo '<script>alert("As senhas informadas não coincidem."); window.location.href = "../pages/usuarios.php";</script>';
			exit();
		} else {
			// Cria o hash da senha usando password_hash() com o algoritmo bcrypt
			$senha_hash = password_hash($putSenha, PASSWORD_BCRYPT);

			// Query 1: Verificar se o usuário já existe na tabela 'users'
			$query_check_usuario = "SELECT * FROM users WHERE email = '$putMail'";
			$result_check_usuario = mysqli_query($conn, $query_check_usuario);

			if (mysqli_num_rows($result_check_usuario) > 0) {
				// Usuário já existe na tabela
				echo '<script>alert("O email do usuário informado já existe."); window.location.href = "../pages/usuarios.php";</script>';
				exit();
			}

			// Query 2: Inserir um novo registro na tabela 'users' com o hash da senha
			$query_insert_usuario = "INSERT INTO users (email, senha_hash, cd_Nivel) VALUES ('$putMail', '$senha_hash', '$putNivel')";
			$result_insert_usuario = mysqli_query($conn, $query_insert_usuario);
			
			// Query 3: Captar o nível de permissão do usuário criado;
			$query_Nivel = "SELECT na.nivel_Acesso
										FROM users u
										INNER JOIN nivel_acesso na ON u.cd_Nivel = na.cd_Nivel
										WHERE u.email = '$putMail';";
			$queryNivelUser = mysqli_query($conn, $query_Nivel);
			$row = mysqli_fetch_assoc($queryNivelUser);
			$nivelUsuario = $row['nivel_Acesso'];

			// Verificar se a segunda query foi executada com sucesso
			if ($result_insert_usuario) {
				// Registrar a movimentação na tabela de logs
				$acaoRealizada = "Criou o usuário: $putMail com o nível: $nivelUsuario";
				registrarLogMovimentacao($emailUsuario, $acaoRealizada);
				
				// Redireciona de volta para a página anterior com um parâmetro "sucesso" na URL
				header("Location: ../pages/usuarios.php?sucesso=1");
				exit();
			} else {
				// Erro na execução da query
				echo "Erro ao criar usuário: " . mysqli_error($conn);
			}
		}
		
		// Fechar conexão com o banco de dados
		mysqli_close($conn);
	?>
