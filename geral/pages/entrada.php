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

<?php // Inclui a página de conexão
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
        <h1>Entrada de Veículos</h1>
        <hr>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filtraPlaca">
            Selecionar placa
        </button>
    </div>
	
	<div class='text-center'><a href='ticket.php' class='btn btn-success mt-4'>Tickets de veículos estacionados</a></div>

    <!-- MODAL FILTRO DA PLACA -->
    <div class="modal fade" id="filtraPlaca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtraPlaca">Selecionar placa do veículo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form method="POST" action="../functions/salvarEntrada.php">
                    <div class="modal-body">
                        <div class="form-group col-md-6">
                            <?php
                            // Query para selecionar as placas dos veículos não estacionados
                            $query = "SELECT v.cd_Veiculo, v.cd_Placa, t.vl_30_minutos, t.vl_1_hora, t.vl_2_horas, t.vl_demais_horas, v.cd_Tipo
                                    FROM veiculo v
                                    INNER JOIN (
                                        SELECT cd_Veiculo, MAX(cd_Registro) AS ultimo_registro
                                        FROM registro
                                        GROUP BY cd_Veiculo
                                    ) r ON v.cd_Veiculo = r.cd_Veiculo
                                    LEFT JOIN registro r2 ON r2.cd_Registro = r.ultimo_registro
                                    LEFT JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
                                    WHERE r2.dt_Saida IS NOT NULL

                                    UNION

                                    SELECT v.cd_Veiculo, v.cd_Placa, t.vl_30_minutos, t.vl_1_hora, t.vl_2_horas, t.vl_demais_horas, v.cd_Tipo
                                    FROM veiculo v
                                    LEFT JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
                                    LEFT JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
                                    WHERE r.cd_Registro IS NULL
                                    ORDER BY cd_Placa ASC;";

                            $result = mysqli_query($conn, $query);

                            echo "<label for='putInfo' class='form-label'>Placa</label>";
                            echo "<select id='putInfo' class='form-control' name='putInfo'>";
                            echo "<option value='' disabled selected style='display: none'>Selecione a placa</option>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['cd_Veiculo'] . "x" . $row['vl_30_minutos'] . "x" . $row['vl_1_hora'] . "x" . $row['vl_2_horas'] . "x" . $row['vl_demais_horas'] . "x" . $row['cd_Tipo'] . "'>" . $row['cd_Placa'] . "</option>";
                            }

                            echo "</select>";
                            ?>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Registrar</button>
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
        echo 'Registrado com sucesso!';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
	
	
	<?php
    // Verifica se há um parâmetro "falha" na URL e exibe uma mensagem se houver
    if (isset($_GET['falha'])) {
		echo "<script>alert('Não há mais vagas para o tipo de veículo pretendido.');</script>";
        echo '<div class="container text-center mt-3">';
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo 'Não há mais vagas para o tipo de veículo pretendido!';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        echo '</div>';
    }
    ?>

    <?php
    $query2 = "SELECT v.cd_Veiculo, v.cd_Placa, v.nm_Modelo, v.nm_Cor, m.nm_Marca, t.nm_Tipo,
       CASE
           WHEN r.cd_Registro IS NOT NULL AND r.dt_Saida IS NULL THEN 'Sim'
           ELSE 'Não'
				   END AS status_estacionamento
			FROM veiculo v
			LEFT JOIN registro r ON v.cd_Veiculo = r.cd_Veiculo
			JOIN marca m ON v.cd_Marca = m.cd_Marca
			JOIN tipo t ON v.cd_Tipo = t.cd_Tipo
			WHERE v.cd_Veiculo = (
				SELECT cd_Veiculo FROM veiculo
				ORDER BY cd_Veiculo DESC
				LIMIT 1
			)
			ORDER BY r.cd_Registro DESC
			LIMIT 1;

			";

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
                        <th scope="col">Estacionado?</th>
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
                        echo "<td>" . $row['status_estacionamento'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    // Fechar conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>

</html>
