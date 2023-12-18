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
?>
   
<!doctype html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Detalhes de Saída</title>
      	<link rel="stylesheet" type="text/css" href="../css/estiloSaida.css">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   </head>
   <body>
      <div class="container mt-3">
         <h1 class="text-center">Detalhes de Saída</h1>
         <div class="card align-items-center" style="max-width: 30rem; margin: auto;">
		 
		<div class="card-body">

		
               <?php
                  // Verifica se foi passado o ID do veículo na URL
                  if (isset($_GET['id'])) {
                      $cdRegistro = $_GET['id'];
                      
                      // Query para obter os dados do veículo com base no ID
                      $query = "SELECT r.cd_Registro, v.cd_Veiculo, v.cd_Placa, t.nm_Tipo, m.nm_Marca, v.nm_Modelo, v.nm_Cor, r.dt_Entrada, r.dt_Saida, r.vl_30_minutos_Atual, r.vl_1_hora_Atual, r.vl_2_horas_Atual, r.vl_demais_horas_Atual
                                          FROM veiculo v
                                          JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
                                          JOIN marca m ON v.cd_Marca = m.cd_Marca
                                          JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
                                          WHERE r.cd_Registro = $cdRegistro
                                          ORDER BY r.cd_Registro DESC
                                          LIMIT 1";
                      
                      
                      $result   = mysqli_query($conn, $query);
                      $registro = mysqli_fetch_assoc($result);
                      
                          // Exibe os dados do veículo no formulário
                          
                          //echo "<p class='card-text m-1'><span class='fw-bold'>Código do Registro: </span>" . $registro['cd_Registro'] . "</p>";
                          //echo "<p class='card-text m-1'><span class='fw-bold'>Código do Veículo: </span>" . $registro['cd_Veiculo'] . "</p>";
                          echo "<p class='card-text m-1'><span class='fw-bold'>Placa do Veículo: </span>" . $registro['cd_Placa'] . "</p>";
                          echo "<p class='card-text m-1'><span class='fw-bold'>Tipo de Veículo: </span>" . $registro['nm_Tipo'] . "</p>";
                          echo "<p class='card-text m-1'><span class='fw-bold'>Marca: </span>" . $registro['nm_Marca'] . "</p>";
                          echo "<p class='card-text m-1'><span class='fw-bold'>Modelo: </span>" . $registro['nm_Modelo'] . "</p>";
                          echo "<p class='card-text m-1'><span class='fw-bold'>Cor: </span>" . $registro['nm_Cor'] . "</p>";
                          
                          // Para retornar o valor do fuso de Brasília caso o horário condiza
                          date_default_timezone_set('America/Sao_Paulo');
                          
                          // Recebe o valor da data e hora que o veículo entrou no Banco de Dados
                          $entrada = $registro['dt_Entrada'];
                          // Formata o valor para data/hora BR
                          $entradaFormatada = date('d/m/Y H:i:s', strtotime($entrada));
                          echo "<p class='card-text m-1'><span class='fw-bold'>Data de Entrada: </span>" . $entradaFormatada . "</p>";
                          
                          $saida = date('Y-m-d H:i:s');
                          $saidaFormatada = date('d/m/Y H:i:s', strtotime($saida));
                          echo "<p class='card-text m-1'><span class='fw-bold'>Data de Saída: </span>" . $saidaFormatada . "</p>";
                          
                          // Código para contabilizar o intervalo entre a Saída e a Entrada do veículo
                          $entradaValor = DateTime::createFromFormat('d/m/Y H:i:s', $entradaFormatada);
                          $saidaValor = DateTime::createFromFormat('d/m/Y H:i:s', $saidaFormatada);
                          
                          $intervalo = $saidaValor->diff($entradaValor);
                          // Número de horas decorridas
                          $horasPassadas = $intervalo->h + ($intervalo->days * 24);
                          
						  // Inicializar a variável de permanência
							$permanenciaString = "";
                          
                          // Verificar se o intervalo é menor que 1 hora
							if ($horasPassadas < 1) {
								$minutosPassados = $intervalo->i;
								// Verificar se o intervalo é menor ou igual a 1 minuto
								if ($minutosPassados < 2) {
									$permanenciaString = $minutosPassados . " minuto";
								} else {
									$permanenciaString = $minutosPassados . " minutos";
								}
							} else {
								// Verificar se a permanência é igual a 1 hora
								if ($horasPassadas == 1) {
									$permanenciaString = $horasPassadas . " hora";
								} else {
									$permanenciaString = $horasPassadas . " horas";
								}
								// Definir minutosPassados para 0 nas condições de 1 hora ou mais
								$minutosPassados = 0;
							}

							// Agora $permanenciaString contém o tempo de permanência como uma string
							echo "<p class='card-text m-1'><span class='fw-bold'>Permanência: </span>" . $permanenciaString . "</p>";


                          
						  $codVeiculo = $registro['cd_Registro'];
						  $codPlaca = $registro['cd_Placa'];
						  $putMarca = $registro['nm_Marca'];
						  $putModelo = $registro['nm_Modelo'];
						  $putCor = $registro['nm_Cor'];
						  
                          // Variável recebe o tipo do veículo (Carro ou moto)
                          $item_Veiculo = $registro['nm_Tipo'];
						  
						  
                          
                         // Obter os valores das novas variáveis
							$vl_30_minutos_Atual = $registro['vl_30_minutos_Atual'];
							$vl_1_hora_Atual = $registro['vl_1_hora_Atual'];
							$vl_2_horas_Atual = $registro['vl_2_horas_Atual'];
							$vl_demais_horas_Atual = $registro['vl_demais_horas_Atual'];

							// Inicializar o valor a pagar como 0
							$valorAPagar = 0;

							// Calcular o tempo de permanência em horas
							$tempoPermanenciaHoras = $horasPassadas + ($minutosPassados / 60);

							// Verificar o tempo de permanência e calcular o valor apropriado
							if ($tempoPermanenciaHoras <= 0.5) { // Até 30 minutos completos
								$valorAPagar = $vl_30_minutos_Atual;
							} elseif ($tempoPermanenciaHoras <= 1) { // De 30 minutos a 1 hora completa
								$valorAPagar = $vl_1_hora_Atual;
							} elseif ($tempoPermanenciaHoras <= 2) { // De 1 hora a 2 horas completas
								$valorAPagar = $vl_1_hora_Atual + $vl_2_horas_Atual;
							} else { // Mais de 2 horas
								// Calcular o valor das horas adicionais (além de 2 horas)
								$horasExtras = $tempoPermanenciaHoras - 2;
								$valorAPagar = $vl_1_hora_Atual + $vl_2_horas_Atual + ($horasExtras * $vl_demais_horas_Atual);
							}

                         // Formatar os valores referente ao tempo de permanência para versão monetária

							$vl_30_minutos_AtualFormatado = 'R$ ' . number_format($vl_30_minutos_Atual, 2, ',', '.');
							$vl_1_hora_AtualFormatado = 'R$ ' . number_format($vl_1_hora_Atual, 2, ',', '.');
							$vl_2_horas_AtualFormatado = 'R$ ' . number_format($vl_2_horas_Atual, 2, ',', '.');
							$vl_demais_horas_AtualFormatado = 'R$ ' . number_format($vl_demais_horas_Atual, 2, ',', '.');

							// Formatar o valor calculado para versão monetária
							$valorAPagarFormatado = 'R$ ' . number_format($valorAPagar, 2, ',', '.');

							
							echo "<ul>";
							echo "<li class='card-text m-1'><span class='fw-bold'>Referência - 30 minutos: </span>" . $vl_30_minutos_AtualFormatado . "</li>";
							echo "<li class='card-text m-1'><span class='fw-bold'>Referência - 01 hora: </span>" . $vl_1_hora_AtualFormatado . "</li>";
							echo "<li class='card-text m-1'><span class='fw-bold'>Referência - 02 horas: </span>" . $vl_2_horas_AtualFormatado . "</li>";
							echo "<li class='card-text m-1'><span class='fw-bold'>Referência - Demais horas: </span>" . $vl_demais_horas_AtualFormatado . "</li>";
							echo "</ul>";

							// Apresentar o valor calculado
							echo "<p id='valorAPagar' class='card-text m-1'><span class='fw-bold'>Valor a pagar: </span>" . $valorAPagarFormatado . "</p>";	
                  }
                  ?>
				  </div>
         </div>
         <?php
            // Valores que serão enviados ao banco de dados
			
            echo "<form id='formConfirmar' method='POST' action='../functions/salvarSaida.php'>
                                    <input type='hidden' name='putCodigo' value='" . $codVeiculo . "' />
                                    <input type='hidden' name='putSaida' value='" . $saida . "' />
                                    <input type='hidden' name='putValor' value='" . $valorAPagar . "' />
									<input type='hidden' name='putPlaca' value='" . $codPlaca . "' />
									<input type='hidden' name='putTipo' value='" . $item_Veiculo . "' />
									<input type='hidden' name='putMarca' value='" . $putMarca . "' />
									<input type='hidden' name='putModelo' value='" . $putModelo . "' />
									<input type='hidden' name='putCor' value='" . $putCor . "' />
									<input type='hidden' name='putEntrada' value='" . $entradaFormatada . "' />
									<input type='hidden' name='putPermanencia' value='" . $permanenciaString . "' />
									<input type='hidden' name='putValor30min' value='" . $vl_30_minutos_AtualFormatado . "' />
									<input type='hidden' name='putValor1hora' value='" . $vl_1_hora_AtualFormatado . "' />
									<input type='hidden' name='putValor2horas' value='" . $vl_2_horas_AtualFormatado . "' />
									<input type='hidden' name='putValorDemaisHoras' value='" . $vl_demais_horas_AtualFormatado . "' />

									<div class='text-center mt-3'>
										<button type='button' class='btn btn-success' onclick='confirmarPagamento()'>Confirmar</button>
</div>
									</div>
									
                                </form>";
            ?>
			
         <div class="text-center mt-3">
            <a href="saida.php" class="btn btn-primary mb-3">Voltar</a>
         </div>
      </div>

  
<script>
    function confirmarPagamento() {
        // Exibe um diálogo de confirmação ao usuário
        var confirmacao = confirm("O valor devido foi pago?");

        // Se o usuário clicar em OK, o formulário será enviado
        if (confirmacao) {
            document.getElementById("formConfirmar").submit();
        } else {
            // Se o usuário clicar em Cancelar, não acontecerá nada
        }
    }
</script>

<p id="demo"></p>
      <?php
         // Fechar conexão com o banco de dados
         mysqli_close($conn);
         ?>
   </body>
</html>