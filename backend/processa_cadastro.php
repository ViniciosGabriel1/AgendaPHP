<?php


include("conexao.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $senha = $_POST["senha"];
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, nome, sobrenome, senha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usuario, $nome, $sobrenome, $hash);

    if ($stmt->execute()) {
        // Redirecione para a página de login com uma mensagem de alerta
        header("Location: ../login.php?cadastro_sucesso=1");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
