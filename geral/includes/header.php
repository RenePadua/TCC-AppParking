<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header('Location: ../pages/login.php');
    exit;
}

// Obter o nível de acesso do usuário logado
$nivelAcesso = '';

if (isset($_SESSION['email'])) {
    // Inclui a página de conexão
	include('../conexao/dbcon.php');

    // Verificar conexão
    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }

    // Obter o email do usuário autenticado
    $email = $_SESSION['email'];

    // Consultar o banco de dados para obter o nível de acesso do usuário
    $query = "SELECT na.nivel_Acesso
				FROM users u
				INNER JOIN nivel_acesso na ON u.cd_Nivel = na.cd_Nivel
				WHERE u.email = '$email'";
    $result = $conn->query($query);

    // Verificar se encontrou algum registro
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $nivelAcesso = $row['nivel_Acesso'];
    }

	
	// Consultar o banco de dados para obter o valor atual do contraste
	$queryContraste = "SELECT contraste_Cor FROM users WHERE email = '$email'";
	$resultContraste = $conn->query($queryContraste);

	// Verificar se encontrou algum registro
	if ($resultContraste->num_rows === 1) {
		$rowContraste = $resultContraste->fetch_assoc();
		$contrasteAtual = $rowContraste['contraste_Cor'];
		$_SESSION['contraste'] = $contrasteAtual;
		$_SESSION['contraste_status'] = $contrasteAtual === '1' ? 'checked' : ''; // Armazena o status do contraste na sessão
	}


    // Fechar a conexão com o banco de dados
    $conn->close();
}

// Array que define quais links são exibidos para cada nível de acesso
$menuLinks = [
    'Administrador' => [
        'Home' => '../pages/index.php',
        'Cadastro' => '../pages/cadastro.php',
        'Entrada' => '../pages/entrada.php',
        'Saída' => '../pages/saida.php',
        'Relatório' => '../pages/relatorio.php',
        'Histórico' => '../pages/historico.php',
        'Valores' => '../pages/valores.php',
		'Marcas' => '../pages/marcas.php',
		'Usuários' => '../pages/usuarios.php',
		'Vagas' => '../pages/vagas.php',
		'Logs' => '../pages/logs.php',
		'Pico' => '../pages/pico.php',
		'Sobre' => '../pages/sobre.php',
        '[Sair]' => '../pages/logout.php'
    ],
	'Proprietário' => [
        'Home' => '../pages/index.php',
        'Cadastro' => '../pages/cadastro.php',
        'Entrada' => '../pages/entrada.php',
        'Saída' => '../pages/saida.php',
        'Relatório' => '../pages/relatorio.php',
        'Histórico' => '../pages/historico.php',
        'Valores' => '../pages/valores.php',
		'Marcas' => '../pages/marcas.php',
		'Usuários' => '../pages/usuarios.php',
		'Vagas' => '../pages/vagas.php',
		'Logs' => '../pages/logs.php',
		'Pico' => '../pages/pico.php',
        '[Sair]' => '../pages/logout.php'
    ],	
    'Gerente' => [
        'Home' => '../pages/index.php',
        'Cadastro' => '../pages/cadastro.php',
        'Entrada' => '../pages/entrada.php',
        'Saída' => '../pages/saida.php',
        'Relatório' => '../pages/relatorio.php',
        'Histórico' => '../pages/historico.php',
        'Valores' => '../pages/valores.php',
		'Marcas' => '../pages/marcas.php',
		'Usuários' => '../pages/usuarios.php',
		'Vagas' => '../pages/vagas.php',
		'Pico' => '../pages/pico.php',
        '[Sair]' => '../pages/logout.php'
    ],
    'Funcionário' => [
        'Home' => '../pages/index.php',
		'Cadastro' => '../pages/cadastro.php',
        'Entrada' => '../pages/entrada.php',
        'Saída' => '../pages/saida.php',
		'Marcas' => '../pages/marcas.php',
		'Usuários' => '../pages/usuarios.php',
        '[Sair]' => '../pages/logout.php'
    ]
];
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estiloHeader.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<nav id="subHeader" class="navbar navbar-expand-lg">
	<div class="container-fluid d-flex flex-row">

		<div class="d-flex">
		<span class="mr-2">Contraste</span>
		<div class="d-flex justify-content-between mx-3">
			<div id="sun">
			<i class="bi bi-sun-fill"></i>
			</div>
				<div class="form-check form-switch"  data-bs-toggle="mode">
					<input class="d-inline form-check-input" type="checkbox" id="contrasteBtn1">
				</div>
			<div>
			<i class="bi bi-moon-stars-fill"></i>
			</div>
		</div>
		
	
		</div>
		
		<div class="position-absolute end-0">
			<?php
				echo "<span>" . $nivelAcesso . ": " .  $email . "</span>";
			?>
		</div>		
	</div>
</nav>
<nav class="navbar navbar-expand-lg navbar">

    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img id="headerimg" src="../img/logo.png" alt="logo projeto" style="width:40px;" class="rounded-pill">
        </a>
        <a id="navbarTitulo" class="navbar-brand" href="#">App Parking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas bg-warning offcanvas-start" tabindex="-1" id="offcanvasNavbar"
             aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">App Parking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
			
			<div class="container">
			
			<?php
				echo "<span id='offcanvasSpan' class='fw-bold'>" . $nivelAcesso . ": " .  $email . "</span>";
			?>
			</div>
			
			<div id="toogleAcess" class="card text-center">
				<span class="mr-2">Contraste</span>
				<div class="d-flex justify-content-between mx-3">
					<div id="sun">
						<i class="bi bi-sun-fill"></i>
					</div>
					<div class="form-check form-switch"  data-bs-toggle="mode">
						<input class="d-inline form-check-input" type="checkbox" id="contrasteBtn2">
					</div>
					<div>
						<i class="bi bi-moon-stars-fill"></i>
					</div>
				</div>
			</div>
			
			
            <div class="offcanvas-body">
               <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
				<?php
				// Exibir os links do menu de acordo com o nível de acesso
					foreach ($menuLinks[$nivelAcesso] as $linkText => $linkUrl) {
						$activeClass = ($paginaAtual === strtolower($linkText)) ? 'active' : '';
						$iconClass = ''; // Inicializa a classe do ícone como vazia

						// Define as classes do ícone de acordo com o texto do link (pode ser ajustado conforme necessário)
						switch ($linkText) {
							case 'Home':
								$iconClass = 'bi-house-door-fill'; // Exemplo: classe do ícone Bootstrap para uma casa
								break;
							case 'Cadastro':
								$iconClass = 'bi-journal-plus'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
							case 'Entrada':
								$iconClass = 'bi-arrow-right-square-fill'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;								
							case 'Saída':
								$iconClass = 'bi-arrow-left-square-fill'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;																
							case 'Relatório':
								$iconClass = 'bi-book'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
							case 'Histórico':
								$iconClass = 'bi-journal-text'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;											
							case 'Marcas':
								$iconClass = 'bi-tags-fill'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;								
							case 'Usuários':
								$iconClass = 'bi-people-fill'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
							case 'Vagas':
								$iconClass = 'bi-distribute-horizontal'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;							
							case 'Valores':
								$iconClass = 'bi bi-cash-coin	'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
							case 'Logs':
								$iconClass = 'bi-pencil-square'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;								
							case 'Pico':
								$iconClass = 'bi bi-graph-up-arrow'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
							case 'Sobre':
								$iconClass = 'bi bi-file-person-fill'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
							case '[Sair]':
								$iconClass = 'bi bi-door-closed-fill'; // Exemplo: classe do ícone Bootstrap para adicionar pessoa
								break;
								
						}

						// Exibe o link com o ícone e o texto
						echo '<li class="nav-item">';
						echo '<a class="nav-link ' . $activeClass . '" href="' . $linkUrl . '">';
						echo '<i class="bi ' . $iconClass . '"> </i>'; // Adiciona o ícone antes do texto
						echo $linkText; // Exibe o texto do link
						echo '</a>';
						echo '</li>';
					}
					?>
				</ul>

            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var contrasteValue = <?php echo $_SESSION['contraste'] ?? 0; ?>; // Valor padrão 0 se não estiver definido na sessão
        var contrasteStatus = "<?php echo $_SESSION['contraste_status'] ?? ''; ?>"; // Status padrão vazio
        
        if (contrasteValue === 1) {
            $("body").addClass("contraste");
        }

        // Atualiza o botão de switch com o status correto
        $("#contrasteBtn1, #contrasteBtn2").prop("checked", contrasteStatus);

        $("#contrasteBtn1, #contrasteBtn2").click(function() {
            $("body").toggleClass("contraste");
            contrasteValue = contrasteValue === 1 ? 0 : 1; // Inverte o valor
            $.ajax({
                url: "../functions/atualizarContraste.php",
                type: "POST",
                data: {
                    email: "<?php echo $email; ?>",
                    contraste: contrasteValue
                },
                success: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>

</body>
</html>
