<?php
require 'conexao/conexao.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar-senha'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $error_message = "As senhas não coincidem!";
    } else {
        // Verifica se o e-mail já está cadastrado
        $stmt = $conn->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $error_message = "Este e-mail já está cadastrado.";
        } else {
            // Insere o novo cliente no banco de dados
            $sql = "INSERT INTO clientes (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha])) {
                $success_message = "Conta criada com sucesso! Você será redirecionado para o login.";
                // Redireciona para a página de login após 3 segundos
                header("refresh:3;url=login.php");
            } else {
                $error_message = "Erro ao criar a conta. Tente novamente.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Infinity Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/criar_conta.css">
</head>

<body>
    <div class="register-container">
        <div class="logo-container">
            <img src="images/logo.png" alt="Infinity Page Logo">
        </div>

        <form id="register-form" method="POST" action="criar_conta.php">
            <div class="form-group">
                <label for="nome">Digite seu nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
            </div>
            <div class="form-group">
                <label for="email">Digite seu e-mail:</label>
                <input type="email" id="email" name="email" placeholder="Seu endereço de e-mail" required>
            </div>
            <div class="form-group">
                <label for="senha">Digite uma senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar-senha">Confirme sua senha:</label>
                <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Repita sua senha" required>
            </div>
            <button type="submit" class="btn-register">Criar conta</button>
        </form>

        <?php if (!empty($success_message)) : ?>
            <div class="success-message" style="background-color: #28a745; color: white; padding: 10px; border-radius: 8px; margin-top: 20px;">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)) : ?>
            <div class="error-message" style="background-color: #dc3545; color: white; padding: 10px; border-radius: 8px; margin-top: 20px; display: block;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="links-container">
            <a href="login.php">Já tem conta? Faça login</a>
        </div>
    </div>

</body>

</html>