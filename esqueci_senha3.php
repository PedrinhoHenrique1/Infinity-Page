<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar nova senha</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/esqueci_senha3.css">
</head>
<body>
    <div class="container">
        <h2>Criar nova senha</h2>
        <form>
            <div class="form-group">
                <label for="senha">Nova senha:</label>
                <input type="password" id="senha" placeholder="Digite sua nova senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar">Confirmar senha:</label>
                <input type="password" id="confirmar" placeholder="Confirme sua nova senha" required>
            </div>
            <button type="button" class="btn-confirmar" onclick="window.location.href='login.php'">
                Confirmar
            </button>
        </form>
    </div>
</body>
</html>
