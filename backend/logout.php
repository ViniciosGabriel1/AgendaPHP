<?php
session_start();

// Destroi a sessão do usuário
session_destroy();

// Redireciona para a página de login
header("Location: ../login.php");
exit();
?>
