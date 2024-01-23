<?php
// Verifica se a sessão está ativa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include "backend/conexao.php";

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
?>
