<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carrinho de Compras</title>
  <link rel="stylesheet" href="css/carrinho.css">
</head>

<body>
  <header class="cabecalho">
    <h1>Carrinho de Compras</h1>
    <a href="inicial.php" class="btn-voltar">← Voltar </a>
  </header>

  <main class="conteudo">
    <section class="carrinho">
      <div class="itens-carrinho">
        <div class="item-card">
          <h3>Livro: O Segredo</h3>
          <p class="preco">Preço: R$ <span>39.90</span></p>
    
          <div class="controle">
            <label>Qtd:</label>
            <input type="number" value="1" min="1" class="quantidade">
          </div>
    
          <div class="subtotal">
            Subtotal: R$ <span>39.90</span>
          </div>
    
          <button class="btn-remover">Remover</button>
        </div>
    
        <div class="item-card">
          <h3>Livro: Dom Casmurro</h3>
          <p class="preco">Preço: R$ <span>25.00</span></p>
    
          <div class="controle">
            <label>Qtd:</label>
            <input type="number" value="2" min="1" class="quantidade">
          </div>
    
          <div class="subtotal">
            Subtotal: R$ <span>50.00</span>
          </div>
    
          <button class="btn-remover">Remover</button>
        </div>
      </div>
    
      <div class="resumo-carrinho">
        <p><strong>Total:</strong> R$ <span id="total">89.90</span></p>
        <button class="btn-finalizar" onclick="window.location.href='pagamento.php'">Finalizar Compra</button>
      </div>
    </section>
  </main>

  <script>
function atualizarTotais() {
  const itens = document.querySelectorAll(".item-card");
  let total = 0;

  itens.forEach((item) => {
    const preco = parseFloat(item.querySelector(".preco span").textContent);
    const quantidade = parseInt(item.querySelector(".quantidade").value) || 0;
    const subtotal = preco * quantidade;
    item.querySelector(".subtotal span").textContent = subtotal.toFixed(2);
    total += subtotal;
  });

  document.getElementById("total").textContent = total.toFixed(2);
}

document.querySelectorAll(".quantidade").forEach(input => {
  input.addEventListener("input", atualizarTotais);
});

document.querySelectorAll(".btn-remover").forEach(botao => {
  botao.addEventListener("click", (event) => {
    event.target.closest(".item-card").remove();
    atualizarTotais();
  });
});

window.addEventListener("load", atualizarTotais);
  </script>
</body>

</html>