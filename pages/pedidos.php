<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="pedidos" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pedidos.css" />
</head>
    <style>
        :root {
            --primary-dark: #1e1f3b;
            --primary-light: #4d6ac5;
            --background-color: #f4f7f9;
            --card-background: #ffffff;
            --text-color: #333;
            --text-light: #666;
            --border-color: #e9eef2;
            --timeline-step-done: #28a745;
            --timeline-step-current: #007bff;
            --timeline-step-pending: #dddddd;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        /* === CABEÇALHO PADRÃO === */
        .main-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary-light));
            padding: 20px 40px;
            color: white;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
        }
        
        .main-header h1 {
            margin: 0;
            font-size: 2.2rem;
        }

        .btn-voltar {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: background-color 0.3s;
        }
        .btn-voltar:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* === CONTAINER PRINCIPAL === */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        /* === CARD DE PEDIDO === */
        .order-card {
            background-color: var(--card-background);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
            margin-bottom: 30px;
            overflow: hidden; /* Garante que o conteúdo respeite o border-radius */
        }
        
        .order-details {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .order-details img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .order-info h3 {
            margin: 0 0 5px 0;
            font-size: 1.3rem;
        }
        .order-info p {
            margin: 5px 0;
            color: var(--text-light);
        }
        
        /* === SEÇÃO DE RASTREAMENTO === */
        .tracking-section {
            padding: 20px;
            background-color: #fafbff;
        }
        
        .tracking-section h2 {
            margin: 0 0 20px 0;
            font-size: 1.2rem;
        }
        
        .timeline {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }
        
        .timeline-step {
            flex: 1;
            text-align: center;
            position: relative;
            color: var(--text-light);
        }

        /* Linha conectora */
        .timeline-step:not(:last-child)::after {
            content: '';
            position: absolute;
            width: 100%;
            top: 12px;
            left: 50%;
            height: 4px;
            background-color: var(--timeline-step-pending);
        }
        
        /* Círculo do passo */
        .timeline-step::before {
            content: '\f058'; /* Ícone de check do Font Awesome */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            margin: 0 auto 10px;
            background-color: var(--background-color);
            border: 4px solid var(--timeline-step-pending);
            color: var(--timeline-step-pending);
        }

        .timeline-step.done::before, .timeline-step.current::before {
            border-color: var(--timeline-step-done);
            color: var(--timeline-step-done);
        }

        .timeline-step.done:not(:last-child)::after {
            background-color: var(--timeline-step-done);
        }
        
        .timeline-step.current::before {
            color: var(--timeline-step-current);
            border-color: var(--timeline-step-current);
        }
        
        .timeline-step.current ~ .timeline-step::before {
             content: '\f111'; /* Ícone de círculo */
        }
        .timeline-step.current ~ .timeline-step:not(:last-child)::after {
            background-color: var(--timeline-step-pending);
        }
        
        /* === SEÇÃO DE AVALIAÇÃO === */
        .review-section {
            padding: 20px;
        }
        .review-section h2 {
            margin: 0 0 15px 0;
            font-size: 1.2rem;
        }
        
        .review-section form label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .review-section form select, .review-section form textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            margin-bottom: 15px;
            font-family: 'Poppins', sans-serif;
        }
        
        .review-section form button {
            background-color: var(--primary-light);
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .review-section form button:hover {
            background-color: var(--primary-dark);
        }

    </style>
<body>

    <header class="main-header">
        <h1>Meus Pedidos</h1>
        <a href="inicial.html" class="btn-voltar">← Voltar</a>
    </header>

    <main class="container">
        <section class="order-card">
            <div class="order-details">
                <img src="../images/jairo-zeppelin.png" alt="Livro 1" />
                <div class="order-info">
                    <h3>Jojo's Bizarre Adventure – Parte 7 – Steel Ball Run 01</h3>
                    <p><strong>Autor:</strong> Hirohiko Araki</p>
                    <p><strong>Preço:</strong> R$ 54,90</p>
                </div>
            </div>
            
            <div class="tracking-section">
                <h2>Rastreamento do Pedido</h2>
                <ul class="timeline">
                    <li class="timeline-step done"><span>Pedido Recebido</span></li>
                    <li class="timeline-step done"><span>Em Separação</span></li>
                    <li class="timeline-step current"><span>Em Transporte</span></li>
                    <li class="timeline-step"><span>A Caminho</span></li>
                    <li class="timeline-step"><span>Entregue</span></li>
                </ul>
            </div>
            
            <div class="review-section">
                <h2>Avaliação do Pedido</h2>
                <form>
                    <label for="nota1">Sua Nota:</label>
                    <select id="nota1" name="nota">
                        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                        <option value="4">⭐️⭐️⭐️⭐️</option>
                        <option value="3">⭐️⭐️⭐️</option>
                        <option value="2">⭐️⭐️</option>
                        <option value="1">⭐️</option>
                    </select>
                    <label for="comentario1">Seu Comentário:</label>
                    <textarea id="comentario1" name="comentario" rows="4" placeholder="Escreva sua opinião..."></textarea>
                    <button type="submit">Enviar Avaliação</button>
                </form>
            </div>
        </section>

        <section class="order-card">
            <div class="order-details">
                <img src="../images/batman.png" alt="Livro 2" />
                <div class="order-info">
                    <h3>Batman: Boa Noite, Bom Cavaleiro</h3>
                    <p><strong>Autor:</strong> Darick Robertson</p>
                    <p><strong>Preço:</strong> R$ 24,90</p>
                </div>
            </div>

            <div class="tracking-section">
                <h2>Rastreamento do Pedido</h2>
                <ul class="timeline">
                    <li class="timeline-step done"><span>Pedido Recebido</span></li>
                    <li class="timeline-step done"><span>Em Separação</span></li>
                    <li class="timeline-step done"><span>Em Transporte</span></li>
                    <li class="timeline-step done"><span>A Caminho</span></li>
                    <li class="timeline-step done"><span>Entregue</span></li>
                </ul>
            </div>

            <div class="review-section">
                <h2>Avaliação do Pedido</h2>
                <form>
                    <label for="nota2">Sua Nota:</label>
                    <select id="nota2" name="nota">
                        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                        <option value="4">⭐️⭐️⭐️⭐️</option>
                        <option value="3">⭐️⭐️⭐️</option>
                        <option value="2">⭐️⭐️</option>
                        <option value="1">⭐️</option>
                    </select>
                    <label for="comentario2">Seu Comentário:</label>
                    <textarea id="comentario2" name="comentario" rows="4" placeholder="Escreva sua opinião..."></textarea>
                    <button type="submit">Enviar Avaliação</button>
                </form>
            </div>
        </section>

    </main>

</body>
</html>