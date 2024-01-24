<?php
<<<<<<< HEAD
include "backend/verificaLogin.php";
=======
include "backend/conexao.php";

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

>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
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
    <title>Sistema de Agendamento</title>
    <?php require 'header.php'; ?>
<<<<<<< HEAD
    <link rel="stylesheet" href="style/index.css">
=======
>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
</head>

<body>

<<<<<<< HEAD
<?php require 'menu.php';  ?>
  
=======
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
                        <a class="dropdown-item logout" href="backend/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>

>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
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
<<<<<<< HEAD
                            <a id="editar" href="editar.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a  id="excluir" href="backend/excluir.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-danger">Excluir</a>
=======
                            <a href="backend/editar.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="backend/excluir.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-danger">Excluir</a>
>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
                        </span>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Nenhum agendamento encontrado.</p>
        <?php endif; ?>
    </div>
<<<<<<< HEAD
    <script src="js/menu.js"></script>
=======

>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc

</body>

</html>