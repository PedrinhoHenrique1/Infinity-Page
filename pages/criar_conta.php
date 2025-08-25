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
        
        .register-container {
            background-color: var(--card-background);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .logo-container {
            margin-bottom: 30px;
        }
        .logo-container img {
            max-width: 290px;
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
        
        .btn-register {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-light);
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-register:hover {
            background-color: var(--primary-dark);
        }

        .links-container {
            margin-top: 25px;
        }
        .links-container a {
            color: var(--primary-light);
            text-decoration: none;
            display: block;
            margin: 10px 0;
            font-weight: 500;
        }
        .links-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="logo-container">
            <img src="../images/logo.png" alt="Infinity Page Logo">
        </div>

        <form id="register-form">
            <div class="form-group">
                <label for="nome">Digite seu nome:</label>
                <input type="text" id="nome" placeholder="Seu nome completo" required>
            </div>
            <div class="form-group">
                <label for="email">Digite seu e-mail:</label>
                <input type="email" id="email" placeholder="Seu endereço de e-mail" required>
            </div>
            <div class="form-group">
                <label for="senha">Digite uma senha:</label>
                <input type="password" id="senha" placeholder="Crie uma senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar-senha">Confirme sua senha:</label>
                <input type="password" id="confirmar-senha" placeholder="Repita sua senha" required>
            </div>
            <button type="submit" class="btn-register">Criar conta</button>
        </form>

        <div class="links-container">
            <a href="login.html">Já tem conta? Faça login</a>
        </div>
    </div>

    <script>
        const form = document.getElementById("register-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            alert("Conta criada com sucesso!");
            setTimeout(function() {
                window.location.href = "./login.html";
            }, 3000);
        });
    </script>
</body>

</html>
