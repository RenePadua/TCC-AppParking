<?php
// Função para registrar o log de movimentação
function registrarLogMovimentacao($emailUsuario, $acaoRealizada) {

	// Inclui a página de conexão
	include('../conexao/dbcon.php');

    // Verificar conexão
    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }

  // Definir o fuso horário para São Paulo, Brasil
    date_default_timezone_set('America/Sao_Paulo');

    // Obter a data e hora atual no formato desejado para o banco de dados (Y-m-d H:i:s)
    $dataHoraAtual = date('Y-m-d H:i:s');

    // Preparar a consulta para inserir o log na tabela logs_movimentacao
    $query = "INSERT INTO logs_movimentacao (data_hora, usuario_email, acao_realizada) VALUES ('$dataHoraAtual', '$emailUsuario', '$acaoRealizada')";

    // Executar a consulta
    if ($conn->query($query) === TRUE) {
        // Log inserido com sucesso

    } else {
        // Erro ao inserir o log
        echo "Erro ao registrar o log: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
	
}

?>
