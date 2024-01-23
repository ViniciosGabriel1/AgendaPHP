<?php 

include "backend/conexao.php";
$usuario_id = $_SESSION['usuario_id'];
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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistema de Agendamento</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link agendar" href="agendar.php">Agendar Novo</a>
                </li>

                <li class="nav-item dropdown">
                    <a onclick="dropdownMenu()" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $nomeUsuario; ?>
                    </a>
                    <div id="dropdown" class="dropdown-menu dropdown-menu-right custom-dropdown" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configurações</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item logout" href="backend/logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>