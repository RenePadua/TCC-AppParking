<?php
ob_start();
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header('Location: ../pages/login.php');
    exit;
}
include('newLog.php');

// Obter o email do usuário autenticado
$emailUsuario = $_SESSION['email'];

?>

<?php
// Inclui a página de conexão
include('../conexao/dbcon.php');

// Verificação de erros na conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Transformando os dados escolhidos no menu em variáveis com valores preenchidos
    $putInfo = $_POST['putInfo'];
    $divisao = explode('x', $putInfo);
    $putVeiculo = $divisao[0];   // Valor antes do 'x' referente ao Código do Veículo
    $putValor30min = $divisao[1];  // Valor após o primeiro 'x' referente ao valor de 30 minutos cobrado pelo tipo do Veículo no momento do ingresso
	$putValor1hora = $divisao[2];  // Valor após o primeiro 'x' referente ao valor de 01 hora cobrado pelo tipo do Veículo no momento do ingresso
	$putValor2horas = $divisao[3];  // Valor após o primeiro 'x' referente ao valor de 02 horas cobrado pelo tipo do Veículo no momento do ingresso
	$putValorDemaisHoras = $divisao[4];  // Valor após o primeiro 'x' referente ao valor de demais horas cobrado pelo tipo do Veículo no momento do ingresso
	$putTipo = $divisao[5];  // Valor após o segundo 'x' referente ao tipo do veículo ingressado

    // Query: Verificar a quantidade de vagas disponíveis para o tipo de veículo selecionado
    $queryVagas = "SELECT tipo.nm_Tipo AS tipoVeiculo, COUNT(registro.cd_Veiculo) AS veiculoEstacionado, vagas.vagas AS vagasExistentes FROM registro INNER JOIN veiculo ON registro.cd_Veiculo = veiculo.cd_Veiculo INNER JOIN tipo ON veiculo.cd_Tipo = tipo.cd_Tipo INNER JOIN vagas ON tipo.cd_Tipo = vagas.tipo_id WHERE tipo.cd_Tipo = '$putTipo' AND registro.dt_Saida IS NULL GROUP BY tipo.nm_Tipo";
    $resultVagas = mysqli_query($conn, $queryVagas);

    // Verificar se a consulta retornou um resultado válido
    if ($rowVagas = mysqli_fetch_assoc($resultVagas)) {
        $vagasExistentes = $rowVagas['vagasExistentes'];
        $veiculosEstacionados = $rowVagas['veiculoEstacionado'];

        if ($veiculosEstacionados >= $vagasExistentes) {
            // Não há mais vagas para o tipo de veículo pretendido
            // Redireciona de volta para a página anterior com um parâmetro "falha" na URL
            header("Location: ../pages/entrada.php?falha=1");
            exit();

        } else {
            // Restante do código (inserir registro, redirecionar, etc.)
			
			// Definir o fuso horário para São Paulo, Brasil
			date_default_timezone_set('America/Sao_Paulo');

			// Obter a data e hora atual no formato desejado para o banco de dados (Y-m-d H:i:s)
			$dataHoraAtual = date('Y-m-d H:i:s');
			
			
            // Query: Inserir um novo registro na tabela 'Registro'
            $query = "INSERT INTO registro (cd_Veiculo, dt_Entrada, dt_Saida, vl_Pagamento, vl_30_minutos_Atual, vl_1_hora_Atual, vl_2_horas_Atual, vl_demais_horas_Atual) VALUES ('$putVeiculo', '$dataHoraAtual', NULL, NULL, '$putValor30min', '$putValor1hora', '$putValor2horas', '$putValorDemaisHoras')";
            $result = mysqli_query($conn, $query);
            
            // Obter o ID do registro recém-inserido
            $cdRegistroInserido = mysqli_insert_id($conn);



            $queryPlaca = "SELECT cd_Placa FROM veiculo WHERE cd_Veiculo = $putVeiculo";
            $resultPlaca = mysqli_query($conn, $queryPlaca);
            $row = mysqli_fetch_row($resultPlaca);
            $putPlaca = $row[0];
            
       
            

            // Verificar se a query foi executada com sucesso
            if ($result) {
                // Sucesso - a query foi executada corretamente
                // Registrar a movimentação na tabela de logs
                $acaoRealizada = "Registrou a entrada do veículo de placa: $putPlaca";
                registrarLogMovimentacao($emailUsuario, $acaoRealizada);
                mysqli_free_result($resultPlaca);
            
                // Redireciona para a página 'gerar_qrcode.php' passando o ID do registro recém-inserido
                header("Location: ../functions/gerar_qrcode.php?id=$cdRegistroInserido");
                exit();
			} else {
				// Erro na execução da query
				echo "Erro ao inserir registro: " . mysqli_error($conn);
			}

        }

    } else {
        // Caso não tenha resultado, assumimos que não há vagas disponíveis para o tipo de veículo pretendido
        // Redireciona de volta para a página anterior com um parâmetro "falha" na URL
        header("Location: ../pages/entrada.php?falha=1");
        exit();
    }
}

// Fechar conexão com o banco de dados
mysqli_close($conn);
?>