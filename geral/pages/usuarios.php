<?php
    ob_start();
	session_start();

	// Verificar se o usuário está autenticado
	if (!isset($_SESSION['email'])) {
		header('Location: login.php');
		exit;
	}
?>

<?php 
	$paginaAtual = 'usuários';
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
	  <link rel="stylesheet" type="text/css" href="../css/estiloUsuarios.css"> 
	  

   </head>
   <body>
      <div class="container text-center mt-3">
         <h1 class="mt-3">Usuários</h1>
		 <hr>
		
	<?php
		if ($nivelAcesso != "Funcionário") {
			echo'
			<button	type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#criarNovoUsuario">Criar Novo Usuário</button>';
		}
		
		else {
			echo '<div style="display: none;">
				<button	type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#criarNovoUsuario">Criar Novo Usuário</button>
				</div>';
			}
	?> 
		 	<div
			  class="modal fade"	
			  id="criarNovoUsuario"
			  tabindex="-1"
			  aria-labelledby="criarNovoUsuario"
			  aria-hidden="true">
			
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="criarNovoUsuario">Novo Usuário</h5>
					<button
					  type="button"
					  class="btn-close btn-close-dark"
					  data-bs-dismiss="modal"
					  aria-label="Close"
					></button>
				  </div>

				  <form method="POST" action="../functions/criarNovoUsuario.php">
					<div class="modal-body">
						<div class="form-group col-md-12">
							<label for="email" class="form-label" id="email">E-mail</label>
							<input
								title="Digite o e-mail"
								class="form-control"
								type="email"
								placeholder="x@email.com"
								id="email"
								name="putMail"
								oninput="this.value = this.value.toLowerCase();"
								required
							/>

							<?php
							// Query 1: Selecionar todos os níveis de permissão
							if ($nivelAcesso == "Desenvolvedor") {
								$query1 = "SELECT * from nivel_acesso WHERE cd_Nivel >= (SELECT cd_Nivel FROM nivel_acesso WHERE nivel_Acesso = '$nivelAcesso') ORDER BY cd_Nivel ASC;";
							}
							else {
								$query1 = "SELECT * from nivel_acesso WHERE cd_Nivel > (SELECT cd_Nivel FROM nivel_acesso WHERE nivel_Acesso = '$nivelAcesso') ORDER BY cd_Nivel ASC;";
							}
							$result1 = mysqli_query($conn, $query1);

							echo "<label for='nivel' class='form-label' id='nivel_Acesso'>Nível de Permissão</label>";
							echo "<select class='form-control' name='putNivel'>";
							echo "<option value='' disabled selected>Selecione o nível</option>";
							while ($row = mysqli_fetch_assoc($result1)) {
								echo "<option value='" . $row['cd_Nivel'] . "'>" . $row['nivel_Acesso'] . "</option>";
							}
							echo "</select>";
							?>

							<label for="senha" class="form-label">Senha</label>
							<input
								type="password" 
								placeholder="Inserir senha do usuário"
								class="form-control"
								id="novaSenha1"
								name="putSenha"
								required
							/>

							<label for="senha" class="form-label">Confirme a senha</label>
							<input
								type="password"
								placeholder="Digite a senha novamente"
								class="form-control"
								id="confirmarSenha1"
								name="putConfirmarSenha"
								required
							/>
							<div class="mt-3 fw-bold" id="senhaAlerta1">As senhas não coincidem.</div>
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
		 
		 
		 
		 <?php
		 
		 if ($nivelAcesso != "Gerente" && $nivelAcesso != "Funcionário") {
			echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alterarNivel">Alterar Nível</button>';
			}
		 else {
			 echo '<div style="display: none;">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alterarNivel">Alterar Nível</button>
			</div>';
			}
		 ?>
		 
		 	<div
			  class="modal fade"	
			  id="alterarNivel"
			  tabindex="-1"
			  aria-labelledby="alterarNivel"
			  aria-hidden="true">
			
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="alterar">Alterar nível de permissão de Usuário</h5>
					<button
					  type="button"
					  class="btn-close btn-close-dark"
					  data-bs-dismiss="modal"
					  aria-label="Close"
					></button>
				  </div>

				  <form method="POST" action="../functions/alterarNivelUsuario.php">
					<div class="modal-body">
					  <div class="form-group col-md-12">
					  
					  
						<?php
						// Query 2: Selecionar todos os níveis de permissão > nível do usuário corrente
						
						if ($nivelAcesso == "Desenvolvedor") {
							$query2 = "SELECT u.id, u.email, na.nivel_Acesso, na.cd_Nivel
									   FROM users u
									   INNER JOIN nivel_acesso na ON u.cd_Nivel = na.cd_Nivel
									   WHERE na.cd_Nivel >= (SELECT cd_Nivel FROM nivel_acesso WHERE nivel_Acesso = '$nivelAcesso')
									   ORDER BY u.email ASC";
						}
						else {
							
							$query2 = "SELECT u.id, u.email, na.nivel_Acesso, na.cd_Nivel
									   FROM users u
									   INNER JOIN nivel_acesso na ON u.cd_Nivel = na.cd_Nivel
									   WHERE na.cd_Nivel > (SELECT cd_Nivel FROM nivel_acesso WHERE nivel_Acesso = '$nivelAcesso')
									   ORDER BY u.email ASC ";
						}
							
							$result2 = mysqli_query($conn, $query2);

						echo "<label for='email' class='form-label' id='email'>Usuário</label>";
						echo "<select class='form-control' name='putMail'>";
						echo "<option value='' disabled selected>Selecione o e-mail do usuário</option>";
						while ($row = mysqli_fetch_assoc($result2)) {
							echo "<option value='" . $row['email'] . "'>" . $row['email'] . "</option>";
						}
						echo "</select>";
						?>
						
						
						<?php
						// Query 1: Selecionar todos os níveis de permissão > nível do usuário corrente
						$result1 = mysqli_query($conn, $query1);

						echo "<label for='nivel' class='form-label' id='nivel_Acesso'>Nível de Permissão</label>";
						echo "<select class='form-control' name='putNivel'>";
						echo "<option value='' disabled selected>Selecione o nível</option>";
						while ($row = mysqli_fetch_assoc($result1)) {
							echo "<option value='" . $row['cd_Nivel'] . "'>" . $row['nivel_Acesso'] . "</option>";
						}
						echo "</select>";
						?>

					  </div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Salvar</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
					</div>
				  </form>
				</div>
			  </div>
			</div>
 


		 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alterarSenha">Alterar Senha</button>
		 
		 	<div
			  class="modal fade"	
			  id="alterarSenha"
			  tabindex="-1"
			  aria-labelledby="alterarSenhaLabel"
			  aria-hidden="true">
			
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="alterarSenhaLabel">Alterar Senha de Usuário</h5>
					<button
					  type="button"
					  class="btn-close btn-close-dark"
					  data-bs-dismiss="modal"
					  aria-label="Close"
					></button>
				  </div>

				  <form method="POST" action="../functions/alterarSenhaUsuario.php">
					<div class="modal-body">
					  <div class="form-group col-md-12">
					  
					  
						<?php
						// Query 2: Selecionar todos os usuários
						$result2 = mysqli_query($conn, $query2);

						echo "<label for='email' class='form-label' id='email'>Usuário</label>";
						echo "<select class='form-control' name='putMail'>";
						echo "<option value='' disabled selected>Selecione o e-mail do usuário</option>";
						?>
					
						<?php // Caso em que o usuário tenha nível de permissão diferente de desenvolvedor
							if ($nivelAcesso != 'Desenvolvedor') {
								echo "<option value='" . $email . "'>" . $email . "</option>";
							}
						
							while ($row = mysqli_fetch_assoc($result2)) {
									echo "<option value='" . $row['email'] . "'>" . $row['email'] . "</option>";
							}
								echo "</select>";
						?>
						
						
						<label for="senha" class="form-label">Senha</label>
						<input
						  type="password"
						  placeholder="Inserir senha do usuário"
						  class="form-control"
						  id="novaSenha2"
						  name="putSenha"
						  required
						/>
						
						<label for="senha" class="form-label">Confirme a senha</label>
						<input
						  type="password"
						  placeholder="Digite a senha novamente"
						  class="form-control"
						  id="confirmarSenha2"
						  name="putConfirmarSenha"
						  required
						/>
						<div class="mt-3 fw-bold" id="senhaAlerta2">As senhas não coincidem.</div>
						
					  </div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="botaoSalvar2">Salvar</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
					</div>
				  </form>
				</div>
			  </div>
			</div>		 
		 


	<?php
		if ($nivelAcesso != "Funcionário") {
			echo'
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirUsuario">Excluir Usuário</button>';
		}
		
		else {
			echo '<div style="display: none;">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirUsuario">Excluir Usuário</button>
				</div>';
			}
	?>
		
		 	<div
			  class="modal fade"	
			  id="excluirUsuario"
			  tabindex="-1"
			  aria-labelledby="excluirUsuario"
			  aria-hidden="true">
			
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="alterar">Excluir Usuário</h5>
					<button
					  type="button"
					  class="btn-close btn-close-dark"
					  data-bs-dismiss="modal"
					  aria-label="Close"
					></button>
				  </div>

				  <form method="POST" action="../functions/excluirUsuario.php">
					<div class="modal-body">
					  <div class="form-group col-md-12">
					  
					  
						<?php
						// Query 2: Selecionar todos os usuários
						$result2 = mysqli_query($conn, $query2);

						echo "<label for='email' class='form-label' id='email'>Excluir Usuário</label>";
						echo "<select class='form-control' name='putMail'>";
						echo "<option value='' disabled selected>Selecione o e-mail do usuário</option>";
						while ($row = mysqli_fetch_assoc($result2)) {
							echo "<option value='" . $row['email'] . "'>" . $row['email'] . "</option>";
						}
						echo "</select>";
						?>
						
						

						
					  </div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza de que deseja excluir o usuário?')">Excluir</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
					</div>
				  </form>
				</div>
			  </div>
			</div>		 
		 
 
	
	<!-- LISTA DE USUÁRIOS  -->		 
		 
        <div class="container mt-3">
  <div class="table-responsive">
    <table class="table align-middle text-center table-bordered table-hover border-dark-subtley table-striped">
      <thead class="table-dark">
        <tr>
          <!--<th scope="col">ID</th> -->
          <th scope="col">Usuário</th>
          <th scope="col">Nível</th>          
        </tr>
      </thead>
      <tbody>
        <?php
		$query3 = "SELECT u.id, u.email, na.nivel_Acesso
				   FROM users u
				   INNER JOIN nivel_acesso na ON u.cd_Nivel = na.cd_Nivel
				   WHERE na.cd_Nivel >= (SELECT cd_Nivel FROM nivel_acesso WHERE nivel_Acesso = '$nivelAcesso')
				   ORDER BY na.cd_Nivel ASC";
			   
			   
			   
			   
		$result3 = mysqli_query($conn, $query3);
        while ($row = mysqli_fetch_assoc($result3)) {
            echo "<tr>";
            //echo "<th scope='row'>" . $row['id'] . "</th>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['nivel_Acesso'] . "</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>  
        </div>
      </div>
	  

<script>
    // Função para verificar se as senhas coincidem no modal de criação de usuário
    function verificarSenhas1() {
        var novaSenha1 = document.getElementById('novaSenha1').value;
        var confirmarSenha1 = document.getElementById('confirmarSenha1').value;
        var alerta = document.getElementById('senhaAlerta1');
        var botaoSalvar = document.getElementById('botaoSalvar1'); // ID do botão de envio do primeiro modal

        // Verificar se ambos os campos não estão vazios
        if (novaSenha1.trim() !== '' && confirmarSenha1.trim() !== '') {
            // Verificar se as senhas são iguais
            if (novaSenha1 === confirmarSenha1) {
                alerta.style.display = 'none'; // Esconder o alerta se as senhas coincidirem
                botaoSalvar.disabled = false; // Habilitar o botão de envio do formulário
            } else {
                alerta.style.display = 'block'; // Exibir o alerta se as senhas não coincidirem
                botaoSalvar.disabled = true; // Desabilitar o botão de envio do formulário
            }
        } else {
            alerta.style.display = 'none'; // Esconder o alerta se algum dos campos estiver vazio
            botaoSalvar.disabled = true; // Desabilitar o botão de envio do formulário
        }
    }

    // Função para verificar se as senhas coincidem no modal de alteração de senha
    function verificarSenhas2() {
        var novaSenha2 = document.getElementById('novaSenha2').value;
        var confirmarSenha2 = document.getElementById('confirmarSenha2').value;
        var alerta = document.getElementById('senhaAlerta2');
        var botaoSalvar = document.getElementById('botaoSalvar2'); // ID do botão de envio do segundo modal

        // Verificar se ambos os campos não estão vazios
        if (novaSenha2.trim() !== '' && confirmarSenha2.trim() !== '') {
            // Verificar se as senhas são iguais
            if (novaSenha2 === confirmarSenha2) {
                alerta.style.display = 'none'; // Esconder o alerta se as senhas coincidirem
                botaoSalvar.disabled = false; // Habilitar o botão de envio do formulário
            } else {
                alerta.style.display = 'block'; // Exibir o alerta se as senhas não coincidirem
                botaoSalvar.disabled = true; // Desabilitar o botão de envio do formulário
            }
        } else {
            alerta.style.display = 'none'; // Esconder o alerta se algum dos campos estiver vazio
            botaoSalvar.disabled = true; // Desabilitar o botão de envio do formulário
        }
    }

    // Event listener para monitorar as mudanças nos campos de senha do primeiro modal
    document.getElementById('novaSenha1').addEventListener('input', verificarSenhas1);
    document.getElementById('confirmarSenha1').addEventListener('input', verificarSenhas1);

    // Event listener para monitorar as mudanças nos campos de senha do segundo modal
    document.getElementById('novaSenha2').addEventListener('input', verificarSenhas2);
    document.getElementById('confirmarSenha2').addEventListener('input', verificarSenhas2);
</script>

      <?php
      // Feche a conexão com o banco de dados
      mysqli_close($conn);
      ?>
   </body>
</html>