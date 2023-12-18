<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>	
	
<?php 
	$paginaAtual = 'saída';
    include('../includes/header.php'); 
?>	
	
<?php
// Inclui a página de conexão
include('../conexao/dbcon.php');

// Atribuído um valor padrão à variável $idQrCode
$idQrCode = 'x';


// Verifica se há um parâmetro na URL
if (isset($_GET['idqrcode'])) {
    // Atualiza $idQrCode com o valor do parâmetro
    $mudarIdQrCode = $_GET['idqrcode'];
    $idQrCode = explode(":", $mudarIdQrCode)[1];
}
	
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém a placa selecionada no filtro
    $placa = $_POST['putPlaca'];

    // Verifica se a opção "Todos os veículos" foi selecionada
    if ($placa == 'all') {
        // Query para exibir todos os registros sem filtro, excluindo os veículos com saída registrada
        $query = "SELECT r.cd_Registro, v.cd_Veiculo, v.cd_Placa, t.nm_Tipo, m.nm_Marca, v.nm_Modelo, v.nm_Cor,  r.dt_Entrada, r.dt_Saida
					FROM veiculo v
					JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
					JOIN marca m ON v.cd_Marca = m.cd_Marca
					JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
					WHERE r.dt_Saida IS NULL
					ORDER BY r.dt_Entrada DESC";
    } else {
        // Query para filtrar por placa, excluindo os veículos com saída registrada
		$query = "SELECT r.cd_Registro, v.cd_Veiculo, v.cd_Placa, t.nm_Tipo, m.nm_Marca, v.nm_Modelo, v.nm_Cor,  r.dt_Entrada, r.dt_Saida
					FROM veiculo v
					JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
					JOIN marca m ON v.cd_Marca = m.cd_Marca
					JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
					WHERE v.cd_Placa = '$placa' AND r.dt_Saida IS NULL
					ORDER BY r.dt_Entrada DESC";
    }
} else {
    // Query para exibir todos os registros sem filtro, excluindo os veículos com saída registrada
    $query = "SELECT r.cd_Registro, v.cd_Veiculo, v.cd_Placa, t.nm_Tipo, m.nm_Marca, v.nm_Modelo, v.nm_Cor,  r.dt_Entrada, r.dt_Saida
					FROM veiculo v
					JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
					JOIN marca m ON v.cd_Marca = m.cd_Marca
					JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
					WHERE r.dt_Saida IS NULL
					ORDER BY r.dt_Entrada DESC";
			  
}

$result = mysqli_query($conn, $query);
?>

<!doctype html>
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
  <h1>Saída de Veículos</h1>
  <hr>


	<?php
	// Query para apresentar os dados provenientes do QR CODE lido
	$queryQrCode = "SELECT r.cd_Registro, v.cd_Veiculo, v.cd_Placa, t.nm_Tipo, m.nm_Marca, v.nm_Modelo, v.nm_Cor, r.dt_Entrada
					FROM veiculo v
					JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
					JOIN marca m ON v.cd_Marca = m.cd_Marca
					JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
					WHERE r.cd_Registro = '$idQrCode' AND r.dt_Saida IS NULL";

	$resultQrCode = mysqli_query($conn, $queryQrCode);

	if (mysqli_num_rows($resultQrCode) > 0) {
		// O veículo está estacionado, exibir tabela
		echo '<div id="table-resultado" class="container mt-3 text-center">';
		echo '<div class="table-responsive">';
		echo '<table class="table align-middle text-center table-bordered table-hover border-dark-subtley table-striped">';
		
		while ($row = mysqli_fetch_assoc($resultQrCode)) {
	  
	  
		echo '<thead class="table-dark">
				 <tr>
					<th>Placa</th>
				 </tr>
			</thead>
         <tr>';
            
			echo '<td>' . $row['cd_Placa'] . '</td>
         </tr>';
		
		echo '<thead class="table-dark">
				 <tr>
					<th>Veículo</th>
				 </tr>	
			</thead>		 
         <tr>';
            echo '<td>' . $row['nm_Tipo'] . '</td>
         </tr>';
		 
		echo '<thead class="table-dark">
				 <tr>
					<th>Marca</th>
				 </tr>
			 </thead>
         <tr>';
            echo '<td>' . $row['nm_Marca'] . '</td>
         </tr>';
		 
		echo '<thead class="table-dark">
				 <tr>
					<th>Modelo</th>
				 </tr>
			 </thead>
         <tr>';
            echo '<td>' . $row['nm_Modelo'] . '</td>
         </tr>';

			 echo '<thead class="table-dark">
			 <tr>
				<th>Cor</th>
			 </tr>
			 </thead>
			 <tr>';
				echo '<td>' . $row['nm_Cor'] . '</td>
			 </tr>';
			
            $entrada = $row["dt_Entrada"];
            // Formata o valor para data/hora BR
            $entradaFormatada = date('d/m/Y - H:i:s', strtotime($entrada));

			 echo '<thead class="table-dark">
			 <tr>
				<th>Entrada</th>
			 </tr>
			 </thead>
         <tr>';
            echo '<td>' . $entradaFormatada . '</td>
         </tr>';
	 

    echo '</table></div></div>';
	
	echo "<a href='verSaida.php?id=" . $row['cd_Registro'] . "' class='btn btn-warning'>Encerrar</a>";
	  }
	
} else {
	// Exibir alerta se o veículo não está estacionado. Caso ainda não haja parâmetro na url e $idQrCode é 'x', não exibir alerta
		// O veículo não está estacionado, exibir mensagem
        if ($idQrCode !== 'x') {
            echo '<div class="alert alert-warning mt-3" role="alert">';
            echo 'Veículo não encontrado ou não está estacionado.';
            echo '</div>';
        }
}
?>
   </div>
</div>


<div class="mt-3" id="resultadoqrcode"></div>

<div class='text-center'><a href='leitor.php' class='btn btn-success my-3'>Leitor de QR Code</a></div>


 <div id="filterbutton"> 
  <button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#filtraPlaca"
  >
    Filtrar placa
  </button>
</div>


<div class="container mt-3">
  <div class="table-responsive">
    <table class="table align-middle text-center table-bordered table-hover border-dark-subtley table-striped">
      <thead class="table-dark">
        <tr>
		<!--
		  <th scope="col">Cód. Registro</th>
          <th scope="col">Cód. Veículo</th>
		 -->
          <th scope="col">Placa</th>
          <th scope="col">Veículo</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Cor</th>
          <th scope="col">Entrada</th>
		  <th scope="col"></th>
          
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
			//echo "<th scope='row'>" . $row['cd_Registro'] . "</th>";
			//echo "<td>" . $row['cd_Veiculo'] . "</td>";
            echo "<td>" . $row['cd_Placa'] . "</td>";
            echo "<td>" . $row['nm_Tipo'] . "</td>";
            echo "<td>" . $row['nm_Marca'] . "</td>";
            echo "<td>" . $row['nm_Modelo'] . "</td>";
            echo "<td>" . $row['nm_Cor'] . "</td>";

            // Recebe o valor do Banco
            $entrada = $row["dt_Entrada"];
            // Formata o valor para data/hora BR
            $entradaFormatada = date('d/m/Y - H:i:s', strtotime($entrada));
            echo "<td>" . $entradaFormatada . "</td>";
			echo "<td>
              <a href='verSaida.php?id=" . $row['cd_Registro'] . "' class='btn btn-warning'>Encerrar</a>
            </td>";
            echo "</tr>";
			
        }
        ?>
      </tbody>
    </table>
  </div>
</div>  

<!-- MODAL FILTRO DA PLACA -->
<div
  class="modal fade"  
  id="filtraPlaca"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filtraPlaca">Filtrar placa do veículo</h5>
        <button
          type="button"
          class="btn-close btn-close-white"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>

      <form method="POST" action="saida.php">
        <div class="modal-body">
          <div class="form-group col-md-6">
            <?php
            // Query para selecionar as placas dos veículos estacionados
            $query1 = "SELECT v.cd_Placa FROM veiculo v 
						JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
						WHERE r.dt_Saida IS NULL
						ORDER BY v.cd_Placa ASC";
            $result1 = mysqli_query($conn, $query1);

            echo "<label for='placa' class='form-label' id='placa'>Placa</label>";
            echo "<select class='form-control' name='putPlaca'>";
            echo "<option value='' disabled selected style='display: none'>Selecione a placa</option>";
            echo "<option value='all'>Todos os veículos</option>";
            while ($row = mysqli_fetch_assoc($result1)) {
                echo "<option value='" . $row['cd_Placa'] . "'>" . $row['cd_Placa'] . "</option>";
            }
            echo "</select>";
            ?>     
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Filtrar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// Fechar conexão com o banco de dados
mysqli_close($conn);
?>

</body>
</html>