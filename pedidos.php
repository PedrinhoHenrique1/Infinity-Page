<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="pedidos" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pedidos.css" />
</head>

<body>

    <header class="main-header">
        <h1>Meus Pedidos</h1>
        <a href="inicial.php" class="btn-voltar">← Voltar</a>
    </header>

    <main class="container">
        <section class="order-card">
            <div class="order-details">
                <img src="images/jairo-zeppelin.png" alt="Livro 1" />
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
                <img src="images/batman.png" alt="Livro 2" />
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