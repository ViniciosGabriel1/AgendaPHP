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
                    ORDER BY appointments.appointment_date";

$resultAgendamentos = $conn->query($sqlAgendamentos);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamento</title>
    <!-- Adicione isso ao head de suas páginas -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Agendamentos</h2>

    <div class="alert alert-info" role="alert">
        Olá, <?php echo $nomeUsuario; ?>! Bem-vindo(a) ao sistema de agendamentos.
    </div>

    <?php if ($resultAgendamentos->num_rows > 0): ?>
        <ul class="list-group">
            <?php while ($rowAgendamento = $resultAgendamentos->fetch_assoc()): ?>
                <li class="list-group-item">
                    <?php 
                        // Reformatar a data para o padrão brasileiro
                        $data_formatada = date("d/m/Y", strtotime($rowAgendamento["appointment_date"]));
                        $horario_formatado = date("H:i", strtotime($rowAgendamento["appointment_date"]));

                        echo $data_formatada . " às " . $horario_formatado . ": " . $rowAgendamento["description"] . " (Agendado por: " . $rowAgendamento["nome_usuario"] . ")"; 
                    ?>
                    <span class="float-right">
                        <a href="editar.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="excluir_admin.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-danger">Excluir</a>
                    </span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum agendamento encontrado.</p>
    <?php endif; ?>

    <a href="agendar.php" class="btn btn-success mt-3">Agendar novo</a>
    <a href="logout.php" class="btn btn-danger mt-3 float-right">Logout</a>

</div>

</body>
</html>
