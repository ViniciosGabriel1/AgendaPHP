<?php
session_start();

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obter a senha armazenada no banco associada ao usuário informado
    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($usuario_id, $senha_armazenada);

    if ($stmt->fetch()) {
        // Comparar a senha fornecida com a senha armazenada usando password_verify
        if (password_verify($senha, $senha_armazenada)) {
            // Senhas correspondem, usuário autenticado com sucesso
            $_SESSION['usuario_id'] = $usuario_id;
            header("Location: index.php");
            exit();
        } else {
            // Senha incorreta
            $erro = "Senha incorreta. Tente novamente.";
        }
    } else {
        // Usuário não encontrado no banco de dados
        $erro = "Usuário não encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .alert-danger {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="usuario"><i class="fas fa-user"></i> Usuário:</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="senha"><i class="fas fa-lock"></i> Senha:</label>
                    <input type="password" id="senha" name="senha" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Entrar</button>
            </form>

            <!-- Botão de Cadastro -->
            <div class="mt-3 text-center">
                <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
