<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$paginaAtual = 'saída';
include('../includes/header.php');

// Inclui a página de conexão
include('../conexao/dbcon.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Parking</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estiloSaida.css">
</head>

<body> 
    <div class="container text-center mt-3">
        <h1>Leitor de QR Code</h1>
        <hr>

        <div class="mt-3" id="resultadoqrcode"></div>

        <div class="container text-center my-3">
            <div id="leitorqr"></div>
        </div>
		
		<div class="text-center mt-3">
			<a href="../pages/saida.php" class="btn btn-primary mb-3">Voltar</a>
        </div>
		 
    </div>

    <?php
    // Fechar conexão com o banco de dados
    mysqli_close($conn);
    ?>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function domReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        domReady(function() {
            var myqr = document.getElementById('resultadoqrcode');
            var scanning = true;

            // Inicializa o scanner
            var html5QrcodeScanner = new Html5QrcodeScanner("leitorqr", {
                fps: 10,
                qrbox: 250,
                facingMode: "environment" // Usa a câmera traseira
            });

            // Função de callback para quando um QR code é escaneado
			function onScanSuccess(decodedText) {
				if (scanning) {
					myqr.textContent = 'Você escaneou ' + decodedText;
					scanning = false; // Define o sinalizador para evitar a detecção de mais QR codes

					// Para o scanner após escanear um QR code
					html5QrcodeScanner.clear().then(() => {
						console.log('Scanner parado com sucesso.');
						// Alterar o estilo do leitor de QR code para ficar oculto após desligar a câmera
						document.getElementById('leitorqr').style.display = 'none';

						// Redireciona para a página "saida.php" com o valor do QR code como parâmetro
						window.location.href = 'saida.php?idqrcode=' + decodedText;
					}).catch((err) => {
						console.error('Erro ao parar o scanner: ', err);
					});
				}
			}

	// Inicia o scanner e passa a função de callback
	html5QrcodeScanner.render(onScanSuccess);
        });
    </script>

</body>
</html>
