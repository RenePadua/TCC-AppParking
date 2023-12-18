<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
$paginaAtual = 'entrada';
include('../includes/header.php');
?>


<?php
// Inclui a página de conexão
include('../conexao/dbcon.php');
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>App Parking</title>
	<link rel="stylesheet" type="text/css" href="../css/estiloEntrada.css">
</head>

<body>

    <div class="container text-center mt-3">
        <h1>QR-CODE</h1>
        <hr>
        


        <?php
                  // Verifica se foi passado o ID do veículo na URL
                  if (isset($_GET['id'])) {
                      $cdRegistro = $_GET['id'];
                      
                      // Query para obter os dados do veículo com base no ID
                      $query = "SELECT r.cd_Registro, v.cd_Veiculo, v.cd_Placa, t.nm_Tipo, m.nm_Marca, v.nm_Modelo, v.nm_Cor, r.dt_Entrada 
                                          FROM veiculo v
                           					JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
											JOIN marca m ON v.cd_Marca = m.cd_Marca
											JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
											WHERE r.cd_Registro = $cdRegistro
											ORDER BY r.cd_Registro DESC
											LIMIT 1";
                      
                      
                      $result   = mysqli_query($conn, $query);
                      $registro = mysqli_fetch_assoc($result);
                      
                          // Exibe os dados do veículo no QR-CODE
                          
						  //Id do registro do Veículo estacionado
						  //$id_registro = $registro['id'];
						  
						  
						  //Exibe o id do registro
						 $idqrcode = $cdRegistro;
						  //Exibe a placa
						  $placa = $registro['cd_Placa'];
						  //Exibe o tipo de veículo
						  $tipo = $registro['nm_Tipo'];
						  //Exibe a marca
						  $marca = $registro['nm_Marca'];
						  //Exibe o modelo
						  $modelo = $registro['nm_Modelo'];
						  //Exibe a cor
						  $cor = $registro['nm_Cor'];
						  
                          // Para retornar o valor do fuso de Brasília caso o horário condiza
                          date_default_timezone_set('America/Sao_Paulo');
                          
                          // Recebe o valor da data e hora que o veículo entrou no Banco de Dados
                          $entrada = $registro['dt_Entrada'];
                          // Formata o valor para data/hora BR
                          $entradaFormatada = date('d/m/Y -  H:i:s', strtotime($entrada));                     
                          
						  $codPlaca = $registro['cd_Placa'];						  
                          
                  }

?>



        <?php
        $msg = 'AppParking - ID:' . $cdRegistro;
        $txt = '../qrcoder/php/qr_img.php?';
        $txt .= 'd=' . $msg;
		//Importante: Caso não funcione a geração de imagem de QR Code, lembrar de habilitar o "extension=gd" no arquivo php.ini.
        ?>


		<div id="qrCode">
    		<h2 id="impressaoTexto"><?php echo $codPlaca; ?></h2>
    		<p id="impressaoTexto"><?php echo $marca . " - " . $modelo; ?></p>
    		<p id="impressaoTexto" class="mb-3"><?php echo $entradaFormatada; ?></p>
    			<img style="border: solid #000; border-radius: 15px;" src="<?php echo $txt; ?>" />
    		<h2 id="impressaoTexto" class="mt-3">App Parking</h2>
    	</div>

		
		<div class='text-center mt-3'>
			<button id="btnImprimir" class="btn btn-warning">Imprimir</button>
		</div>


        <div class="text-center mt-3">
            <a href="../pages/entrada.php" class="btn btn-primary mb-3">Voltar</a>
         </div>
	
	</div>



	<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("btnImprimir").addEventListener("click", function () {
                window.print();
            });
        });
    </script>

    <?php
    // Fechar conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>
</html>