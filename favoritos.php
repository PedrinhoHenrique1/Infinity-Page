<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Favoritos</title>
  <link rel="stylesheet" href="css/favoritos.css" />
</head>

<body>
  <header class="cabecalho">
    <h1>Meus Favoritos</h1>
    <a href="inicial.php" class="btn-voltar">← Voltar</a>
  </header>

  <main class="conteudo">
    <section class="grid-favoritos">
      <div class="card-favorito">
        <img src="images/jairo-zeppelin.png" alt="Livro 1" />
        <h3> Jojo's Bizarre Adventure – Parte 7 – Steel Ball Run 01</h3>
        <p>Autor: Hirohiko Araki </p>
        <p class="preco">Preço: R$ 54,90</p>
        <div class="acoes">
          <button class="btn-adicionar">Adicionar ao Carrinho</button>
          <button class="btn-remover">Remover</button>
        </div>
      </div>

      <div class="card-favorito">
        <img src="images/batman.png" alt="Livro 2" />
        <h3> Batman: Boa Noite, Bom Cavaleiro </h3>
        <p>Autor: Darick Robertson </p>
        <p class="preco">Preço: R$ 24,90</p>
        <div class="acoes">
          <button class="btn-adicionar">Adicionar ao Carrinho</button>
          <button class="btn-remover">Remover</button>
        </div>
      </div>

      <!-- Repita os cards conforme necessário -->
    </section>
  </main>
</body>
</html>
