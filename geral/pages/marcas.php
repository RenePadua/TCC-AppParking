<?php
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>

<?php 
	$paginaAtual = 'marcas';
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
	  <link rel="stylesheet" type="text/css" href="../css/estiloMarcas.css"> 
   </head>
   <body>
      <div class="container text-center mt-3">
         <h1 class="mt-3">Marcas de Veículo</h1>
		 <hr>
		<div id="marcabuttons">
		<button	id="marcabutton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#criarNovaMarca">Criar Nova Marca</button>
	
		 
		 	<div
			  class="modal fade"	
			  id="criarNovaMarca"
			  tabindex="-1"
			  aria-labelledby="criarNovaMarca"
			  aria-hidden="true">
			
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="criarNovaMarca">Nova Marca</h5>
					<button
					  type="button"
					  class="btn-close btn-close-dark"
					  data-bs-dismiss="modal"
					  aria-label="Close"
					></button>
				  </div>

				  <form method="POST" action="../functions/criarNovaMarca.php">
					<div class="modal-body">
						<div class="form-group">
							<label for="marca1" class="form-label" id="marca1">Marca</label>
							<input
								title="Digite a marca"
								class="form-control"
								type="text"
								placeholder="Digite a marca"
								id="marca"
								name="putMarca"
								oninput="this.value = this.value.toUpperCase();"
								required
							/>
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="botaoSalvar1">Salvar</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
					</div>
				</form>

				</div>
			  </div>
			</div>
		 
		 
		 <button id="marcabutton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirMarca">Excluir Marca</button>
		  	<div
			  class="modal fade"	
			  id="excluirMarca"
			  tabindex="-1"
			  aria-labelledby="excluirMarca"
			  aria-hidden="true">
			
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="excluir">Excluir Marca</h5>
					<button
					  type="button"
					  class="btn-close btn-close-dark"
					  data-bs-dismiss="modal"
					  aria-label="Close"
					></button>
				  </div>

				  <form method="POST" action="../functions/excluirMarca.php">
					<div class="modal-body">
					  <div class="form-group col-md-12">
					  
					  
						<?php
					// Query 2: Selecionar todas as marcas
					$query2 = "SELECT * FROM marca ORDER BY nm_Marca ASC";
					$result2 = mysqli_query($conn, $query2);

						echo "<label for='marca2' class='form-label' id='marca2'>Selecionar Marca</label>";
						echo "<select class='form-control' name='putMarca'>";
						echo "<option value='' disabled selected>Marcas de veículo</option>";
						while ($row = mysqli_fetch_assoc($result2)) {
							echo "<option value='" . $row['nm_Marca'] . "'>" . $row['nm_Marca'] . "</option>";
						}
						echo "</select>";
						?>
						
						

						
					  </div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza de que deseja excluir a marca?')">Excluir</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
					</div>
				  </form>
				</div>
			  </div>
			</div>		 
		 
	</div>
	 

<?php
    // Verifica se há um parâmetro "sucesso" na URL e exibe uma mensagem se houver
    if (isset($_GET['sucesso'])) {
        echo '<div class="container text-center mt-3">';
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo 'Procedimento realizado com sucesso!';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        echo '</div>';
    }
?>




	<!-- LISTA DE MARCAS  -->		 
		 
        <div class="container mt-3">
  <div class="table-responsive">
    <table class="table align-middle text-center table-bordered table-hover border-dark-subtley table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">Marcas</th>         
        </tr>
      </thead>
      <tbody>
        <?php
		$query3 = "SELECT * FROM marca ORDER BY nm_Marca ASC";
		$result3 = mysqli_query($conn, $query3);
        while ($row = mysqli_fetch_assoc($result3)) {
            echo "<tr>";
            echo "<th>" . $row['nm_Marca'] . "</th>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>  
         </div>
      </div>
	  

      <?php
      // Feche a conexão com o banco de dados
      mysqli_close($conn);
      ?>
   </body>
</html>
