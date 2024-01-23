

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro</title>
    <?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/login_cadastro.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Cadastro</h2>

                <form method="post" action="backend/processa_cadastro.php">
                    <div class="form-group">
                        <label for="usuario">Usuário:</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sobrenome">Sobrenome:</label>
                        <input type="text" id="sobrenome" name="sobrenome" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                </form>
                <div class="mt-3 text-center">
                <p>Já tem uma conta? <a href="login.php">Faça Login</a></p>
            </div>
            </div>
        </div>
    </div>

</body>
</html>
