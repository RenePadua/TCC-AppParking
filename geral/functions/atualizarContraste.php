<?php
session_start();

if (isset($_POST['contraste'])) {
    $contraste = $_POST['contraste'];

    // Conecte-se ao banco de dados
    include('../conexao/dbcon.php');

    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }

    // Obtenha o email do usuário autenticado
    $email = $_SESSION['email'];

    // Atualize o valor na coluna contraste_Cor
    $queryUpdate = "UPDATE users SET contraste_Cor = '$contraste' WHERE email = '$email'";

    if ($conn->query($queryUpdate) === TRUE) {
        $_SESSION['contraste'] = $contraste; // Armazena a configuração do contraste na sessão
		echo "Sucesso";
    } else {
        echo "Erro no SQL: " . $conn->error; // Exibir mensagem de erro do SQL
    }

    $conn->close();
}
?>
