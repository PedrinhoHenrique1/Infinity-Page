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

    <style>
        :root {
            --primary-dark: #1e1f3b;
            --primary-light: #4d6ac5;
            --background-color: #f4f7f9;
            --card-background: #92bbf0;
            --text-color: #333;
            --danger-red: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .edit-container {
            background-color: var(--card-background);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .edit-container h1 {
            margin-bottom: 25px;
            color: var(--primary-dark);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-light);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
        }

        .btn-secondary {
            background-color: #555;
        }

        .btn-secondary:hover {
            background-color: #333;
        }
    </style>
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
                window.location.href = "minha_conta.html";
            }, 2000);
        });

        function voltar() {
            window.location.href = "minha_conta.html";
        }
    </script>
</body>

</html>
