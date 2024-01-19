<?php
include "conexao.php";

// Inicie a sessão para acessar as variáveis de sessão
session_start();


// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    // Redirecione para a página de login ou faça alguma ação adequada
    header("Location: login.php");
    exit();
}

// Obtém o ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Obtenha as informações do usuário logado
$sqlUsuario = "SELECT nome FROM usuarios WHERE id = $usuario_id";
$resultUsuario = $conn->query($sqlUsuario);

if ($resultUsuario->num_rows > 0) {
    $rowUsuario = $resultUsuario->fetch_assoc();
    $nomeUsuario = $rowUsuario['nome'];
} else {
    $nomeUsuario = "Usuário Desconhecido";
}

// Obter todos os agendamentos do banco de dados, incluindo informações do usuário logado
$sqlAgendamentos = "SELECT appointments.*, usuarios.nome AS nome_usuario 
                    FROM appointments
                    LEFT JOIN usuarios ON appointments.usuario_id = usuarios.id
                    WHERE usuarios.id = $usuario_id
                    ORDER BY appointments.appointment_date";

$resultAgendamentos = $conn->query($sqlAgendamentos);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Agendamento</title>
    <!-- Adicione isso ao head de suas páginas -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistema de Agendamento</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link agendar" href="agendar.php">Agendar Novo</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $nomeUsuario; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right custom-dropdown" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configurações</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item logout" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Agendamentos</h2>

        <div class="alert alert-info" role="alert">
            Olá, <?php echo $nomeUsuario; ?>! Bem-vindo(a) ao sistema de agendamentos.
        </div>

        <?php if ($resultAgendamentos->num_rows > 0) : ?>
            <ul class="list-group">
                <?php while ($rowAgendamento = $resultAgendamentos->fetch_assoc()) : ?>
                    <li class="list-group-item">
                        <?php
                        $data_formatada = date("d/m/Y", strtotime($rowAgendamento["appointment_date"]));
                        $horario_formatado = date("H:i", strtotime($rowAgendamento["appointment_date"]));

                        echo $data_formatada . " às " . $horario_formatado . ": " . $rowAgendamento["description"] . " (Agendado por: " . $rowAgendamento["nome_usuario"] . ")";
                        ?>
                        <span class="float-right">
                            <a href="editar.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="excluir.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-danger">Excluir</a>
                        </span>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Nenhum agendamento encontrado.</p>
        <?php endif; ?>
    </div>


</body>

</html>