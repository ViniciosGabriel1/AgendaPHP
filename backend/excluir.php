<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $agendamento_id = $_GET["id"];
    $usuario_id = $_SESSION["usuario_id"];

    // Verificar se o agendamento pertence ao usuário logado
    $stmt_verificar_agendamento = $conn->prepare("SELECT id FROM appointments WHERE id = ? AND usuario_id = ?");
    $stmt_verificar_agendamento->bind_param("ii", $agendamento_id, $usuario_id);
    $stmt_verificar_agendamento->execute();
    $stmt_verificar_agendamento->store_result();

    if ($stmt_verificar_agendamento->num_rows > 0) {
        // O agendamento pertence ao usuário, podemos proceder com a exclusão
        $stmt_excluir_agendamento = $conn->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt_excluir_agendamento->bind_param("i", $agendamento_id);

        if ($stmt_excluir_agendamento->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            $erro_exclusao = "Erro ao excluir agendamento. Por favor, tente novamente.";
        }

        $stmt_excluir_agendamento->close();
    } else {
        // O agendamento não pertence ao usuário
        $erro_exclusao = "Você não tem permissão para excluir este agendamento.";
    }

    $stmt_verificar_agendamento->close();
} else {
    $erro_exclusao = "ID do agendamento não fornecido.";
}
?>
