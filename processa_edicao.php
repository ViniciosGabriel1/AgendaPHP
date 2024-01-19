<?php
include "conexao.php";

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se um ID foi fornecido na URL
if (!isset($_POST['id']) || empty($_POST['id'])) {
    header("Location: index.php");
    exit();
}

// Obtém o ID do agendamento do formulário
$id_agendamento = $_POST['id'];

// Verifica se o formulário foi enviado (após a edição)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os novos dados do formulário
    $novo_appointment_date = $_POST["appointment_date"];
    $nova_description = $_POST["description"];

    // Use declarações preparadas para evitar injeções de SQL
    $sql_update = "UPDATE appointments SET appointment_date = ?, description = ? WHERE id = ?";

    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssi", $novo_appointment_date, $nova_description, $id_agendamento);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Redireciona após a atualização
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar o registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit(); // Evita a execução do restante do código após a atualização
}

// Se chegou até aqui, significa que ainda não foi enviado o formulário de edição

// A parte HTML do seu formulário de edição permanece a mesma...
?>
