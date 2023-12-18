<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}

?>

<?php 
	$paginaAtual = 'cadastro';
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fatec Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/estiloCadastro.css">
  </head>
  
  <body> 	
	<div class="container text-center mt-3">
	  <h1>Cadastro de Veículos</h1>
	  <hr>
	  <button
		type="button"
		class="btn btn-primary"
		data-bs-toggle="modal"
		data-bs-target="#exampleModal"
	  >
		Cadastrar veículo
	  </button>
	</div>

	<div
	  class="modal fade"	
	  id="exampleModal"
	  tabindex="-1"
	  aria-labelledby="exampleModalLabel"
	  aria-hidden="true">
	
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Cadastro do veículo</h5>
			<button
			  type="button"
			  class="btn-close btn-close-dark"
			  data-bs-dismiss="modal"
			  aria-label="Close"
			></button>
		  </div>

		  <form id="cadastro" method="POST" action="../functions/salvarCadastro.php">
			<div class="modal-body">
			  <div class="form-group col-md-6">
				<label for="placa" id="placa">Placa</label>
				<input
					pattern="[A-Za-z0-9]{7}"
					title="Digite a placa completa"
					maxlength="7"
					class="form-control"
					type="text"
					placeholder="ex.: XXX0000"
					id="placa"
					name="putPlaca"
					oninput="this.value = this.value.toUpperCase();"
					required
				/>

				<label for="tipo" class="form-label">Tipo de Veículo</label>
				<select class="form-control" name="putVeiculo" required>
				  <option value='' disabled selected>Selecione o tipo</option>
				  <option value="1">Carro</option>
				  <option value="2">Moto</option>
				</select>

				<?php
				// Query 1: Selecionar todos as marcas de veículo
				$query1 = "SELECT * FROM marca ORDER BY nm_Marca ASC";
				$result1 = mysqli_query($conn, $query1);

				echo "<label for='marca' class='form-label' id='marca'> Marca </label>";
				echo "<select class='form-control' name='putMarca'>";
				echo "<option value='' disabled selected>Selecione a marca</option>";
				while ($row = mysqli_fetch_assoc($result1)) {
					echo "<option value='" . $row['cd_Marca'] . "'>" . $row['nm_Marca'] . "</option>";
				}
				echo "</select>";
				?>

				<label for="modelo" class="form-label">Modelo</label>
				<input
				  type="text"
				  placeholder="Inserir modelo do veículo"
				  class="form-control"
				  id="modelo"
				  name="putModelo"
				  required
				/>

				<label for="cor" class="form-label" id="cor">Cor</label>
				<select class="form-control" name="putCor" required>
				  <option value="" disabled selected>Selecione a Cor</option>
				  <datalist id="opcCor">
					<option value="..Outros">..Outros</option>
					<option value="Amarelo">Amarelo</option>
					<option value="Azul">Azul</option>
					<option value="Branco">Branco</option>
					<option value="Cinza">Cinza</option>
					<option value="Marrom">Marrom</option>
					<option value="Prata">Prata</option>
					<option value="Preto">Preto</option>
					<option value="Verde">Verde</option>
					<option value="Vermelho">Vermelho</option>
				  </datalist>
				</select>
			  </div>
			</div>

			<div id="cadastrobuttomodal" class="modal-footer">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
			</div>
		  </form>
		</div>
	  </div>
	</div>


	
<?php
    // Verifica se há um parâmetro "sucesso" na URL e exibe uma mensagem se houver
    if (isset($_GET['sucesso'])) {
        echo '<div class="container text-center mt-3">';
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo 'Cadastrado com sucesso!';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        echo '</div>';
    }
?>


<?php
$query2 = "SELECT v.cd_Placa, v.nm_Modelo, v.nm_Cor, t.nm_Tipo, m.nm_Marca
				FROM veiculo v
				JOIN marca m ON v.cd_Marca = m.cd_Marca
				JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
			JOIN (
				SELECT MAX(cd_Veiculo) AS cd_Veiculo
				FROM veiculo
			) max_v ON v.cd_Veiculo = max_v.cd_Veiculo;";

$result2 = mysqli_query($conn, $query2);
?>

   


<div class="container mt-4 text-center">

<hr>

<h4>Último Veículo cadastrado</h4>

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
          <th scope="col">Atalho</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<tr>";
			//echo "<th scope='row'>" . $row['cd_Registro'] . "</th>";
			//echo "<td>" . $row['cd_Veiculo'] . "</td>";
            echo "<td>" . $row['cd_Placa'] . "</td>";
            echo "<td>" . $row['nm_Tipo'] . "</td>";
            echo "<td>" . $row['nm_Marca'] . "</td>";
            echo "<td>" . $row['nm_Modelo'] . "</td>";
            echo "<td>" . $row['nm_Cor'] . "</td>";
            echo "<td> <a href='entrada.php' class='btn btn-warning'>Ir para Entrada</a>
            </td>";
            echo "</tr>";
			
        }
        ?>





<?
    // Fechar conexão com o banco de dados
    mysqli_close($conn);
?>
  </body>
</html>
