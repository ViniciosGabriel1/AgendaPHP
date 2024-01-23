<?php
// Simples exemplo de autenticação de usuário (substitua pelo seu sistema de autenticação real)
$usuariodb = $_POST["usuario"];
$senhadb = $_POST["senha"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if ($usuario == $usuariodb && $senha == $senhadb) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        $erro = "Usuário ou senha incorretos.";
    }
}
?>