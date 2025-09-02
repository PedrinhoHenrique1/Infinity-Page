<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Redefinir senha </title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/esqueci_senha2.css">
</head>
<body>
    <div class="container">
        <h2>Redefinir senha</h2>
        <form>
            <div class="form-group">
                <label for="codigo">Digite o código enviado para o e-mail:</label>
                <input type="text" id="codigo" placeholder="Código de verificação">
            </div>
            <button type="button" class="btn-prosseguir" onclick="window.location.href='Esqueci_senha3.php'">
                Prosseguir
            </button>
        </form>
    </div>
</body>
</html>
