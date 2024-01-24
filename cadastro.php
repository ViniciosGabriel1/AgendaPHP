

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro</title>
    <?php require 'header.php'; ?>
<<<<<<< HEAD
    <link rel="stylesheet" href="style/login_cadastro.css">
=======
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin-top: 50px;
        }
    </style>
>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
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
<<<<<<< HEAD
                <div class="mt-3 text-center">
                <p>Já tem uma conta? <a href="login.php">Faça Login</a></p>
            </div>
=======
>>>>>>> 3213bf317996c288ce9fb4fab3b779e47536f8cc
            </div>
        </div>
    </div>

</body>
</html>
