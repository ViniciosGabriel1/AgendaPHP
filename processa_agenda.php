<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION["usuario_id"];
    $appointment_date = $_POST["appointment_date"];
    $description = $_POST["description"];

    // Verificar se o usuario_id existe na tabela usuarios
    $stmt_verificar_usuario = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
    $stmt_verificar_usuario->bind_param("i", $usuario_id);
    $stmt_verificar_usuario->execute();
    $stmt_verificar_usuario->store_result();

    if ($stmt_verificar_usuario->num_rows > 0) {
        // O usuário existe, então podemos proceder com a inserção na tabela appointments
        $stmt = $conn->prepare("INSERT INTO appointments (usuario_id, appointment_date, description) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $usuario_id, $appointment_date, $description);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $erro_insercao = "Erro ao agendar. Por favor, tente novamente.";
        }

        $stmt->close();
    } else {
        // O usuário não existe na tabela usuarios
        $erro_insercao = "Usuário não encontrado. Por favor, faça o login novamente.";
    }

    $stmt_verificar_usuario->close();
}
?>
