<?php
include "backend/conexao.php";
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<title>Agendar Novo</title>
   <?php require 'header.php'; ?>
</head>
<body>

<?php require 'menu.php';  ?>

    <div class="container mt-5">
        <h2>Agendar Novo</h2>

        <form method="post" action="backend/processa_agenda.php" class="mt-3">
            <div class="form-group">
                <label for="appointment_date">Data do Agendamento:</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>

        <br>
        <a href="index.php" class="btn btn-secondary">Voltar para a página inicial</a>
    </div>
    <script src="js/menu.js"></script>
</body>

</html>