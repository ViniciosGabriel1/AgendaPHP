<?php
include "conexao.php";

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se um ID foi fornecido na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Editar Agendamento</h2>

    <form method="POST" action="processa_edicao.php" class="mt-3">
        <input type="hidden" name="id" value="<?= $id_agendamento; ?>">

        <div class="form-group">
            <label for="appointment_date">Data do Agendamento:</label>
            <input type="datetime-local" id="appointment_date" name="appointment_date" class="form-control" value="<?= $appointment_date; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea id="description" name="description" rows="4" class="form-control" required><?= $description; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Edição</button>
    </form>

    <br>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</div>

</body>
</html>