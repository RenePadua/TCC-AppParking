<?php
// definições de host, database, usuário e senha
		$host = 'localhost'; 
		$user = 'id21353622_tccappparking2023';
		$pass = '@ppParking2023';
		$dbname = 'id21353622_tccappparking2023';
		$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificação de erros na conexão
	if (!$conn) {
		die("Conexão falhou: " . mysqli_connect_error());
	}

?>