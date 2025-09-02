<?php
session_start();
require 'conexao/conexao.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se é um funcionário (admin)
    $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE email = :email AND senha = :senha");
    $stmt->execute(['email' => $email, 'senha' => $senha]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($funcionario) {
        $_SESSION['user_id'] = $funcionario['id_funcionario'];
        if ($funcionario['permissao'] === 'Administrador') {
            $_SESSION['user_name'] = 'Administrador';
        } else {
            $_SESSION['user_name'] = $funcionario['nome'];
        }
        $_SESSION['user_type'] = $funcionario['permissao'];

        if ($funcionario['permissao'] === 'Administrador') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: inicial.php");
            exit();
        }
    }

    // Verifica se é um cliente
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE email = :email AND senha = :senha");
    $stmt->execute(['email' => $email, 'senha' => $senha]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $_SESSION['user_id'] = $cliente['id_cliente'];
        $_SESSION['user_name'] = $cliente['nome'];
        $_SESSION['user_type'] = 'cliente';
        header("Location: inicial.php");
        exit();
    }

    $error_message = "Usuário ou senha inválidos.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Infinity Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="images/logo.png" alt="Infinity Page Logo">
        </div>

        <form id="login-form" method="POST" action="login.php">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <?php if (!empty($error_message)) : ?>
            <div id="error-message" class="error-message" style="display: block;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="links-container">
            <a href="esqueci_senha1.php">Esqueci minha senha</a>
            <a href="criar_conta.php">Ainda não tem conta? Crie uma agora!</a>
        </div>
    </div>
</body>

</html>