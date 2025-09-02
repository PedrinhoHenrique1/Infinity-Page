<?php
session_start(); // Inicia a sessão para verificar se o usuário está logado
require 'conexao/conexao.php'; // Inclui a conexão com o banco de dados

try {
    // Busca todos os produtos no banco de dados
    $stmt = $conn->query("SELECT * FROM produtos ORDER BY titulo");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem e encerra o script
    die("Erro ao buscar produtos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Infinity Page </title>
    <link rel="stylesheet" href="css/inicial.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body>

    <button class="menu-btn" id="toggle-btn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h2> Opções </h2>
        </div>
        <ul>
            <li><a href="inicial.php"><i class="fa-solid fa-house"></i> Início </a></li>
            <li><a href="pedidos.php"><i class="fa-solid fa-bag-shopping"></i> Meus pedidos </a></li>
            <li><a href="favoritos.php"><i class="fa-solid fa-star"></i> Favoritos </a></li>
            <li><a href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i> Carrinho </a></li>
            <li><a href="trocas.php"><i class="fa-solid fa-arrows-rotate"></i> Trocas </a></li>
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Administrador') : ?>
                <li><a href="admin.php"><i class="fa-solid fa-gear"></i> Administração</a></li>
            <?php endif; ?>
            <li><a href="login.php"><i class="fa-solid fa-door-open"></i> Sair </a></li>
        </ul>
    </div>

    <header>
        <div class="logo">
            <img src="images/logo.png" width="150px">
        </div>
        <div class="texto">
            <input type="search" id="buscaItem" placeholder="O que você busca hoje?" oninput="filtrarItens()">
        </div>
        <div class="trade">
            <a href="trocas.php"> Trocas </a>
        </div>
        <div class="atendimento">
            <a href="atendimento.php"> Atendimento ao Cliente </a>
        </div>
        <div class="icons">
            <div class="favorite">
                <a href="favoritos.php">
                    <i class="fa-solid fa-heart fa-3x" style="color: #ffffff;"></i>
                </a>
            </div>
            <div class="cart">
                <a href="carrinho.php">
                    <i class="fa-solid fa-cart-shopping fa-3x" style="color: #ffffff;"></i>
                </a>
            </div>
            <div id="area-login">
                <?php if (isset($_SESSION['user_name'])) : ?>
                    <div class="usuario-logado" style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-user fa-3x" style="color: #ffffff;"></i>
                        <span style="color: white;"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="login.php" style="background:none;border:none;color:white;cursor:pointer;text-decoration: none;">Sair</a>
                    </div>
                <?php else : ?>
                    <button id="btn-login" onclick="window.location.href='login.php'">Login</button>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main id="conteudo-principal">
        <nav>
            <ul>
                <li><a href="#novidades"> Novidades </a></li>
                <li><a href="#esportes"> Esportes </a></li>
                <li><a href="#dc_comics"> DC Comics </a></li>
                <li><a href="#marvel"> Marvel </a></li>
            </ul>
        </nav>

        <nav2>
            <button class="dc-button" data-category="ficcao"> Ficção </button>
            <button class="dc-button" data-category="romance"> Romance </button>
            <button class="dc-button" data-category="comedia"> Comédia </button>
            <button class="dc-button" data-category="quadrinhos"> Quadrinhos </button>
            <button class="dc-button" data-category="academico"> Acadêmico </button>
            <button class="dc-button" data-category="colecionaveis"> Colecionáveis </button>
        </nav2>

        <section id="secao-produtos">
            <section>
                <h2> Novidades </h2>
            </section>
            <div class="products-container">
                <?php if (count($produtos) > 0) : ?>
                    <?php foreach ($produtos as $produto) : ?>
                        <div class="product" onclick="mostrarDetalhe('detalhe-produto-<?php echo $produto['id_produto']; ?>')">
                            <?php
                            // Corrige o caminho da imagem, removendo o '../' se existir
                            $imageUrl = !empty($produto['imagem_url']) ? str_replace('../', '', $produto['imagem_url']) : 'images/placeholder.png';
                            ?>
                            <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($produto['titulo']); ?>">
                            <h3><?php echo htmlspecialchars($produto['titulo']); ?></h3>
                            <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            <button class="buy-button">Comprar</button>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Nenhum produto encontrado.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php foreach ($produtos as $produto) : ?>
        <section id="detalhe-produto-<?php echo $produto['id_produto']; ?>" class="produto-detalhe" style="display: none;">
            <div class="produto-detalhe-container">
                <button class="produto-detalhe-voltar" onclick="voltarParaHome()">← Voltar</button>
                <div class="produto-detalhe-box">
                    <div class="produto-detalhe-img">
                        <?php
                        // Corrige o caminho da imagem também na seção de detalhes
                        $imageUrl = !empty($produto['imagem_url']) ? str_replace('../', '', $produto['imagem_url']) : 'images/placeholder.png';
                        ?>
                        <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($produto['titulo']); ?>">
                    </div>
                    <div class="produto-detalhe-info">
                        <h2><?php echo htmlspecialchars($produto['titulo']); ?></h2>
                        <p class="produto-detalhe-subtitulo">Por <?php echo htmlspecialchars($produto['autor']); ?></p>
                        <div class="produto-detalhe-avaliacao">
                            <span>★★★★☆</span>
                            <small>(Avaliações)</small>
                        </div>
                        <p class="produto-detalhe-preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <p class="produto-detalhe-descricao"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                        <ul class="produto-detalhe-tecnico">
                            <li><strong>Editora:</strong> <?php echo htmlspecialchars($produto['editora']); ?></li>
                            <li><strong>Idioma:</strong> <?php echo htmlspecialchars($produto['idioma']); ?></li>
                            <li><strong>Encadernação:</strong> <?php echo htmlspecialchars($produto['encadernacao']); ?></li>
                            <li><strong>Número de páginas:</strong> <?php echo htmlspecialchars($produto['numero_paginas']); ?></li>
                            <li><strong>Data de lançamento:</strong> <?php echo date('d/m/Y', strtotime($produto['data_lancamento'])); ?></li>
                        </ul>
                        <div class="produto-detalhe-compra">
                            <label for="quantidade-<?php echo $produto['id_produto']; ?>">Quantidade:</label>
                            <input type="number" id="quantidade-<?php echo $produto['id_produto']; ?>" name="quantidade" min="1" value="1">
                            <a href="pagamento.php">
                                <button class="produto-detalhe-btn"> Comprar </button>
                            </a>
                            <button class="produto-detalhe-btn"> Adicionar ao carrinho</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>


    <script src="js/inicial.js"> </script>
    <script>
        // Botão lateral
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Corrige campo de busca
        function filtrarItens() {
            const termo = document.querySelector("input[type='search']").value.toLowerCase();
            const itens = document.querySelectorAll(".product");

            itens.forEach((item) => {
                const nomeItem = item.textContent.toLowerCase();
                item.style.display = nomeItem.includes(termo) ? "block" : "none";
            });
        }
    </script>

</body>

</html>