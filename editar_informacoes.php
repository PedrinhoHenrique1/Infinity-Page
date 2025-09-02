<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informações - Infinity Page</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/editar_informacoes.css">
</head>

<body>
    <div class="edit-container">
        <h1>Editar Minhas Informações</h1>
        
        <form id="edit-form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Seu Nome Aqui" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="seuemail@exemplo.com" required>
            </div>
            <button type="submit" class="btn">Salvar Alterações</button>
        </form>

        <button class="btn btn-secondary" onclick="voltar()">Voltar</button>
    </div>

    <script>
        const form = document.getElementById("edit-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            alert("Alterações salvas com sucesso!");
            setTimeout(function() {
                window.location.href = "minha_conta.php";
            }, 2000);
        });

        function voltar() {
            window.location.href = "minha_conta.php";
        }
    </script>
</body>

</html>
