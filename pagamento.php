<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Tela de Pagamento</title>
  <link rel="stylesheet" href="css/pagamento.css">

</head>
<body>

  <div class="container">
    
    <!-- Resumo do Pedido -->
    <div class="resumo">
      <h2>Resumo do Pedido</h2>
      <div class="resumo-pedido">
        <div class="item-pedido">
          <span>Livro: O Senhor dos Anéis</span>
          <span>R$ 49,90</span>
        </div>
        <div class="item-pedido">
          <span>Livro: 1984</span>
          <span>R$ 29,90</span>
        </div>
        <div class="item-pedido">
          <span>Livro: Dom Casmurro</span>
          <span>R$ 19,90</span>
        </div>
        <div class="total">
          <span>Total:</span>
          <span>R$ 99,70</span>
        </div>
      </div>
    </div>

    <!-- Formulário de Pagamento -->
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

      <form id="form-pagamento" action="">
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
          <p>Ao finalizar, um boleto será gerado com vencimento em até 3 dias úteis.</p>
          <label for="cpf-boleto">CPF do comprador</label>
          <input type="text" id="cpf-boleto" name="cpf-boleto">
        </div>

        <div id="pagamento-pix" style="display:none;">
          <p>Ao finalizar, um QR Code será gerado para pagamento instantâneo.</p>
          <label for="cpf-pix">CPF ou CNPJ</label>
          <input type="text" id="cpf-pix" name="cpf-pix">
        </div>

        <button type="submit">Finalizar Pagamento</button>
      </form>
    </div>
    
  </div>

  <script>
    function trocarMetodo() {
      const metodo = document.getElementById("metodo").value;

      document.getElementById("pagamento-cartao").style.display = "none";
      document.getElementById("pagamento-boleto").style.display = "none";
      document.getElementById("pagamento-pix").style.display = "none";

      if (metodo === "cartao") {
        document.getElementById("pagamento-cartao").style.display = "block";
      } else if (metodo === "boleto") {
        document.getElementById("pagamento-boleto").style.display = "block";
      } else if (metodo === "pix") {
        document.getElementById("pagamento-pix").style.display = "block";
      }
    }
  </script>

</body>
</html>