<?php
session_start();

// Verificar se o usuário já está autenticado
if (isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter as credenciais enviadas pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar as credenciais (utilizando a nova função de validação de senha)
    if (validarCredenciais($email, $senha)) {
        // Login bem-sucedido
        $_SESSION['email'] = $email;
        header('Location: index.php');
        exit;
    } else {
        // Credenciais inválidas
        $erro = 'E-mail ou senha inválido. Tente novamente.';
    }
}

function validarCredenciais($email, $senha) {
	// Inclui a página de conexão
	include('../conexao/dbcon.php');

    // Verificar conexão
    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }

    // Evitar SQL injection
    $email = $conn->real_escape_string($email);

    // Consultar o banco de dados para encontrar o usuário correspondente às credenciais
    $query = "SELECT senha_hash FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    // Verificar se encontrou algum registro
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hash = $row['senha_hash'];

        // Verificar a senha usando password_verify()
        if (password_verify($senha, $hash)) {
            // Senha válida
            return true;
        }
    }

    // Senha inválida ou usuário não encontrado
    return false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estiloLogin.css"> 
	
</head>
<body id="login">
    <div class="container mt-5">
        <?php if (isset($erro)): ?>
            <div id="loginalert" class="alert alert-danger text-center mb-5">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>

        <div id="grupoItens" class="container">
            
			<div id="mesmalinha">
				<div>
					<img id="loginimg" src="../img/logoColor.png" alt="logo projeto">
				</div>
				<div class="text-center">
					<h2>App Parking</h2>
				</div>
            </div>
			
            <div id="loginform">
                <form method="POST">
                    <div>
                        <label id="loginlabel" for="email">E-mail:</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                            placeholder="Digite seu e-mail" required>
                    </div>
                    <div>
                        <label id="loginlabel" for="senha">Senha:</label>
                        <input type="password" class="form-control form-control-lg" id="senha" name="senha"
                            placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit" class="btn btn-lg my-3">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>