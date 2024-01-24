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
<<<<<<< HEAD
   <link rel="stylesheet" href="style/editar.css">
</head>
<body>

<?php require 'menu.php';  ?>
=======
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
>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc

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

<<<<<<< HEAD
            <button  type="submit" class="btn btn-primary">Agendar</button>
        </form>

        <br>
        <a  href="index.php" class="btn btn-secondary">Voltar para a página inicial</a>
    </div>
    <script src="js/menu.js"></script>
=======
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>

        <br>
        <a href="index.php" class="btn btn-secondary">Voltar para a página inicial</a>
    </div>

>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
</body>

</html>