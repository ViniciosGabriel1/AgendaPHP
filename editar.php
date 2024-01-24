<?php
include "backend/verificaLogin.php";

// Obtém o ID do agendamento da URL
$id_agendamento = $_GET['id'];

// Obtém os detalhes do agendamento com base no ID
$sql = "SELECT * FROM appointments WHERE id = $id_agendamento";
$result = $conn->query($sql);

// Verifica se o agendamento existe
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

$row = $result->fetch_assoc();
$appointment_date = $row['appointment_date'];
$description = $row['description'];

// Outras verificações ou processamentos necessários podem ser adicionados aqui

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Agendamento</title>
    <?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/editar.css">
</head>
<body>
<?php require 'menu.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Agendamento</h2>

    <form method="POST" action="backend/processa_edicao.php" class="mt-3">
        <input type="hidden" name="id" value="<?= $id_agendamento; ?>">

        <div class="form-group">
            <label for="appointment_date">Data do Agendamento:</label>
            <input type="datetime-local" id="appointment_date" name="appointment_date" class="form-control" value="<?= $appointment_date; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea id="description" name="description" rows="4" class="form-control" required><?= $description; ?></textarea>
        </div>

        <button type="submit" id="saveedit" class="btn btn-primary">Salvar Edição</button>
        <a id="cancelaredit" href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="js/menu.js"></script>
</body>
</html>