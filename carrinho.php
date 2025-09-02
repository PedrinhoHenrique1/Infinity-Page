<?php
session_start();
require 'conexao/conexao.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$id_cliente = $_SESSION['user_id'];

try {
  // Query atualizada para buscar também a imagem do produto
  $stmt = $conn->prepare(
    "SELECT p.id_produto, p.titulo, p.preco, p.imagem_url, c.quantidade
         FROM carrinho c
         JOIN produtos p ON c.id_produto = p.id_produto
         WHERE c.id_cliente = :id_cliente"
  );
  $stmt->execute(['id_cliente' => $id_cliente]);
  $itens_carrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Erro ao buscar itens do carrinho: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho de Compras - Infinity Page</title>
  <link rel="stylesheet" href="css/carrinho.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header class="main-header">
    <h1>Meu Carrinho</h1>
    <a href="inicial.php" class="btn-voltar">
      <i class="fas fa-arrow-left"></i> Continuar Comprando
    </a>
  </header>

  <main class="container">
    <div class="cart-layout">
      <section class="cart-items">
        <?php if (empty($itens_carrinho)): ?>
          <div class="cart-empty">
            <i class="fas fa-shopping-cart fa-4x"></i>
            <h2>Seu carrinho está vazio.</h2>
            <p>Adicione livros ao seu carrinho para vê-los aqui.</p>
          </div>
        <?php else: ?>
          <?php foreach ($itens_carrinho as $item): ?>
            <div class="cart-item" data-id-produto="<?php echo $item['id_produto']; ?>">
              <div class="item-image">
                <?php
                // Corrige o caminho da imagem
                $imageUrl = !empty($item['imagem_url']) ? str_replace('../', '', $item['imagem_url']) : 'images/placeholder.png';
                ?>
                <img src="<?php echo htmlspecialchars($imageUrl); ?>"
                  alt="<?php echo htmlspecialchars($item['titulo']); ?>">
              </div>
              <div class="item-details">
                <h3><?php echo htmlspecialchars($item['titulo']); ?></h3>
                <p class="item-price">R$ <span
                    class="unit-price"><?php echo number_format($item['preco'], 2, ',', '.'); ?></span></p>
                <div class="item-quantity">
                  <label for="qtd-<?php echo $item['id_produto']; ?>">Qtd:</label>
                  <input type="number" id="qtd-<?php echo $item['id_produto']; ?>" class="quantidade"
                    value="<?php echo $item['quantidade']; ?>" min="1">
                </div>
              </div>
              <div class="item-subtotal">
                <p>Subtotal</p>
                <span>R$ <span
                    class="subtotal-value"><?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></span></span>
              </div>
              <div class="item-actions">
                <button class="btn-remover"><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </section>

      <?php if (!empty($itens_carrinho)): ?>
        <aside class="cart-summary">
          <h2>Resumo do Pedido</h2>
          <div class="summary-row">
            <span>Subtotal</span>
            <span id="summary-subtotal">R$ 0,00</span>
          </div>

          <div class="frete-calculator">
            <label for="cep">Calcular Frete:</label>
            <div style="display: flex; gap: 10px; margin-top: 5px;">
              <input type="text" id="cep" placeholder="Digite seu CEP"
                style="flex: 1; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
              <button id="btn-calcular-frete"
                style="padding: 8px 12px; background-color: var(--primary-light); color: white; border: none; border-radius: 5px; cursor: pointer;">OK</button>
            </div>
            <div id="resultado-frete" style="margin-top: 10px;"></div>
          </div>
          <div class="summary-row">
            <span>Frete</span>
            <span id="summary-frete">A calcular</span>
          </div>
          <div class="summary-total">
            <span>Total</span>
            <span id="summary-total">R$ 0,00</span>
          </div>
          <button class="btn-checkout">Finalizar Compra</button>
        </aside>
      <?php endif; ?>
    </div>
  </main>

  <script>
    function atualizarTotais() {
      const itens = document.querySelectorAll(".cart-item");
      let totalCarrinho = 0;

      itens.forEach((item) => {
        const precoUnitarioText = item.querySelector(".unit-price").textContent.replace('.', '').replace(',', '.').trim();
        const precoUnitario = parseFloat(precoUnitarioText);
        const quantidade = parseInt(item.querySelector(".quantidade").value) || 0;
        const subtotal = precoUnitario * quantidade;

        item.querySelector(".subtotal-value").textContent = subtotal.toFixed(2).replace('.', ',');
        totalCarrinho += subtotal;
      });

      const totalFormatado = totalCarrinho.toFixed(2).replace('.', ',');
      document.getElementById("summary-subtotal").textContent = `R$ ${totalFormatado}`;
      document.getElementById("summary-total").textContent = `R$ ${totalFormatado}`;
    }

    document.querySelectorAll(".quantidade").forEach(input => {
      input.addEventListener("input", atualizarTotais);
    });

    document.querySelectorAll(".btn-remover").forEach(botao => {
      botao.addEventListener("click", (event) => {
        const itemCard = event.target.closest(".cart-item");
        const idProduto = itemCard.getAttribute('data-id-produto');

        fetch('remover_carrinho.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id_produto: idProduto })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              itemCard.remove();
              atualizarTotais();
              // Se o carrinho ficar vazio, recarrega a página para mostrar a mensagem
              if (document.querySelectorAll(".cart-item").length === 0) {
                window.location.reload();
              }
            } else {
              alert(data.message || 'Erro ao remover o item.');
            }
          })
          .catch(error => console.error('Erro:', error));
      });
    });

    window.addEventListener("load", atualizarTotais);
  </script>

  <script>
    // Função original para atualizar os totais
    function atualizarTotais() {
      const itens = document.querySelectorAll(".cart-item");
      let subtotalCarrinho = 0;

      itens.forEach((item) => {
        const precoUnitarioText = item.querySelector(".unit-price").textContent.replace('.', '').replace(',', '.').trim();
        const precoUnitario = parseFloat(precoUnitarioText);
        const quantidade = parseInt(item.querySelector(".quantidade").value) || 0;
        const subtotal = precoUnitario * quantidade;

        item.querySelector(".subtotal-value").textContent = subtotal.toFixed(2).replace('.', ',');
        subtotalCarrinho += subtotal;
      });

      // Pega o valor do frete que foi calculado
      const freteText = document.getElementById("summary-frete").textContent;
      let valorFrete = 0;
      if (freteText.toLowerCase().includes('r$')) {
        valorFrete = parseFloat(freteText.replace('R$', '').replace(',', '.').trim());
      }

      const totalCarrinho = subtotalCarrinho + valorFrete;

      const subtotalFormatado = subtotalCarrinho.toFixed(2).replace('.', ',');
      const totalFormatado = totalCarrinho.toFixed(2).replace('.', ',');

      document.getElementById("summary-subtotal").textContent = `R$ ${subtotalFormatado}`;
      document.getElementById("summary-total").textContent = `R$ ${totalFormatado}`;
    }

    // Script original para quantidade e remoção
    document.querySelectorAll(".quantidade").forEach(input => {
      input.addEventListener("input", atualizarTotais);
    });

    document.querySelectorAll(".btn-remover").forEach(botao => {
      botao.addEventListener("click", (event) => {
        const itemCard = event.target.closest(".cart-item");
        const idProduto = itemCard.getAttribute('data-id-produto');

        fetch('remover_carrinho.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id_produto: idProduto })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              itemCard.remove();
              atualizarTotais();
              if (document.querySelectorAll(".cart-item").length === 0) {
                window.location.reload();
              }
            } else {
              alert(data.message || 'Erro ao remover o item.');
            }
          })
          .catch(error => console.error('Erro:', error));
      });
    });

    // --- NOVO SCRIPT PARA O CÁLCULO DE FRETE ---
    document.getElementById('btn-calcular-frete').addEventListener('click', function () {
      const cep = document.getElementById('cep').value;
      const resultadoDiv = document.getElementById('resultado-frete');
      const freteSummary = document.getElementById('summary-frete');

      resultadoDiv.textContent = 'Calculando...';
      freteSummary.textContent = '...';

      fetch('calcular_frete.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cep: cep })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            resultadoDiv.innerHTML = `Valor: <strong>R$ ${data.valor}</strong> <br> Prazo: <strong>${data.prazo} dias</strong>`;
            freteSummary.textContent = `R$ ${data.valor}`;
          } else {
            resultadoDiv.textContent = data.message || 'Não foi possível calcular o frete.';
            freteSummary.textContent = 'Erro';
          }
          // Após calcular o frete, atualiza o total geral
          atualizarTotais();
        })
        .catch(error => {
          console.error('Erro:', error);
          resultadoDiv.textContent = 'Erro na requisição.';
          freteSummary.textContent = 'Erro';
          atualizarTotais();
        });
    });


    // Carrega os totais iniciais ao carregar a página
    window.addEventListener("load", atualizarTotais);
  </script>

</body>

</html>