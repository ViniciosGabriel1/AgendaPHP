<?php
include "backend/verificaLogin.php";
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
    <link rel="stylesheet" href="style/index.css">
</head>

<body>

<?php require 'menu.php';  ?>
  
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
                            <a id="editar" href="editar.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a  id="excluir" href="backend/excluir.php?id=<?php echo $rowAgendamento["id"]; ?>" class="btn btn-sm btn-danger">Excluir</a>
                        </span>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Nenhum agendamento encontrado.</p>
        <?php endif; ?>
    </div>
    <script src="js/menu.js"></script>

</body>

</html>