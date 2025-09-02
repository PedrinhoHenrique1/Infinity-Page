<?php
session_start();
require 'conexao/conexao.php';

try {
    $stmt_produtos = $conn->query("SELECT * FROM produtos ORDER BY titulo");
    $produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);

    $stmt_categorias = $conn->query("SELECT * FROM categorias ORDER BY nome_categoria");
    $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

    // Busca dados para os filtros
    $autores = $conn->query("SELECT DISTINCT autor FROM produtos WHERE autor IS NOT NULL ORDER BY autor")->fetchAll(PDO::FETCH_ASSOC);
    $editoras = $conn->query("SELECT DISTINCT editora FROM produtos WHERE editora IS NOT NULL ORDER BY editora")->fetchAll(PDO::FETCH_ASSOC);
    $idiomas = $conn->query("SELECT DISTINCT idioma FROM produtos WHERE idioma IS NOT NULL ORDER BY idioma")->fetchAll(PDO::FETCH_ASSOC);
    $max_preco_result = $conn->query("SELECT MAX(preco) as max_preco FROM produtos")->fetch(PDO::FETCH_ASSOC);
    $max_preco = $max_preco_result ? ceil($max_preco_result['max_preco']) : 100;


} catch (PDOException $e) {
    die("Erro ao buscar dados: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Infinity Page </title>
    <link rel="stylesheet" href="css/inicial.css">
    <link rel="stylesheet" href="css/modal_pagamento.css">
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
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Administrador'): ?>
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
                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="usuario-logado" style="display: flex; align-items: center; gap: 10px;">
                        <a href="minha_conta.php"
                            style="text-decoration: none; color: white; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-user fa-3x" style="color: #ffffff;"></i>
                            <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        </a>
                        <a href="login.php"
                            style="background:none;border:none;color:white;cursor:pointer;text-decoration: none;">Sair</a>
                    </div>
                <?php else: ?>
                    <button id="btn-login" onclick="window.location.href='login.php'">Login</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main id="conteudo-principal">
        <nav2>
            <button class="dc-button active" data-category-id="0"> Todos </button>
            <?php foreach ($categorias as $categoria): ?>
                <button class="dc-button" data-category-id="<?php echo $categoria['id_categoria']; ?>">
                    <?php echo htmlspecialchars($categoria['nome_categoria']); ?>
                </button>
            <?php endforeach; ?>
        </nav2>

        <div class="loja-container">
            <div class="conteudo-loja">
                <section id="secao-produtos">
                    <h2 id="titulo-categoria"> Todos os Produtos </h2>
                    <div class="products-container">
                    </div>
                </section>
            </div>
        </div>
    </main>

    <div id="detalhes-container">
        <?php foreach ($produtos as $produto): ?>
            <section id="detalhe-produto-<?php echo $produto['id_produto']; ?>" class="produto-detalhe"
                style="display: none;">
                <div class="produto-detalhe-container">
                    <button class="produto-detalhe-voltar" onclick="voltarParaHome()">← Voltar</button>
                    <div class="produto-detalhe-box">
                        <div class="produto-detalhe-img">
                            <?php
                            $imageUrl = !empty($produto['imagem_url']) ? str_replace('../', '', $produto['imagem_url']) : 'images/placeholder.png';
                            ?>
                            <img src="<?php echo htmlspecialchars($imageUrl); ?>"
                                alt="<?php echo htmlspecialchars($produto['titulo']); ?>">
                        </div>
                        <div class="produto-detalhe-info">
                            <h2><?php echo htmlspecialchars($produto['titulo']); ?></h2>
                            <p class="produto-detalhe-subtitulo">Por <?php echo htmlspecialchars($produto['autor']); ?></p>
                            <div class="produto-detalhe-avaliacao">
                                <span>★★★★☆</span>
                                <small>(Avaliações)</small>
                            </div>
                            <p class="produto-detalhe-preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                            </p>
                            <p class="produto-detalhe-descricao">
                                <?php echo nl2br(htmlspecialchars($produto['descricao'])); ?>
                            </p>
                            <ul class="produto-detalhe-tecnico">
                                <li><strong>Editora:</strong> <?php echo htmlspecialchars($produto['editora']); ?></li>
                                <li><strong>Idioma:</strong> <?php echo htmlspecialchars($produto['idioma']); ?></li>
                                <li><strong>Encadernação:</strong> <?php echo htmlspecialchars($produto['encadernacao']); ?>
                                </li>
                                <li><strong>Número de páginas:</strong>
                                    <?php echo htmlspecialchars($produto['numero_paginas']); ?></li>
                                <li><strong>Data de lançamento:</strong>
                                    <?php echo htmlspecialchars($produto['data_lancamento']); ?></li>
                            </ul>
                            <div class="produto-detalhe-compra">
                                <label for="quantidade-<?php echo $produto['id_produto']; ?>">Quantidade:</label>
                                <input type="number" id="quantidade-<?php echo $produto['id_produto']; ?>" name="quantidade"
                                    min="1" value="1">
                                <button class="produto-detalhe-btn buy-button"> Comprar </button>
                                <button class="produto-detalhe-btn add-to-cart-btn"
                                    data-id="<?php echo $produto['id_produto']; ?>"> Adicionar ao carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    </div>

    <div id="pagamento-modal" class="modal-pagamento" style="display: none;">
        <div class="modal-pagamento-content">
            <span class="fechar-modal">&times;</span>
            <section class="payment-section">
                <div class="resumo">
                    <h2>Resumo do Pedido</h2>
                    <div class="resumo-pedido" id="resumo-pedido-modal">
                    </div>
                    <div class="total">
                        <span>Total:</span>
                        <span id="total-pedido-modal">R$ 0,00</span>
                    </div>
                </div>

                <div class="pagamento">
                    <h2>Informações de Pagamento</h2>
                    <div class="metodo-pagamento">
                        <label for="metodo">Método de Pagamento</label>
                        <select id="metodo" onchange="trocarMetodo()">
                            <option value="cartao">Cartão de Crédito</option>
                            <option value="boleto">Boleto Bancário</option>
                            <option value="pix">Pix</option>
                        </select>
                    </div>
                    <form id="form-pagamento-modal" action="processar_pagamento.php" method="POST">
                        <div id="pagamento-cartao">
                            <label for="nome">Nome no Cartão</label>
                            <input type="text" id="nome" name="nome" required>
                            <label for="numero-cartao">Número do Cartão</label>
                            <input type="text" id="numero-cartao" name="numero-cartao" maxlength="16" required>
                            <label for="validade">Validade (MM/AA)</label>
                            <input type="text" id="validade" name="validade" placeholder="MM/AA" required>
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" maxlength="4" required>
                        </div>
                        <div id="pagamento-boleto" style="display:none;">
                            <p>Um boleto será gerado ao finalizar a compra.</p>
                            <label for="cpf-boleto">CPF do comprador</label>
                            <input type="text" id="cpf-boleto" name="cpf-boleto">
                        </div>

                        <div id="pagamento-pix" style="display:none;">
                            <p>Um QR Code será gerado para pagamento.</p>
                            <label for="cpf-pix">CPF ou CNPJ</label>
                            <input type="text" id="cpf-pix" name="cpf-pix">
                        </div>
                        <button type="submit">Finalizar Pagamento</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script src="js/inicial.js"> </script>
    <script src="js/pagamento.js"></script>
</body>

</html>