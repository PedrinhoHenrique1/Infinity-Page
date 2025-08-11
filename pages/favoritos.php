<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Favoritos</title>
  <link rel="stylesheet" href="favoritos.css" />
</head>

<style>
    body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f5f5f9;
  margin: 0;
  padding: 0;
  color: #333;
}

.cabecalho {
  background: linear-gradient(to right, #1e1f3b, #4d6ac5);
  color: white;
  padding: 30px 20px;
  text-align: center;
  position: relative;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.cabecalho h1 {
  margin: 0;
  font-size: 32px;
}

.btn-voltar {
  position: absolute;
  left: 20px;
  top: 20px;
  background-color: rgba(255, 255, 255, 0.15);
  color: white;
  padding: 8px 14px;
  border: 1px solid #fff;
  border-radius: 6px;
  text-decoration: none;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.btn-voltar:hover {
  background-color: rgba(255, 255, 255, 0.3);
}

.conteudo {
  max-width: 1100px;
  margin: 40px auto;
  padding: 20px;
}

.grid-favoritos {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 24px;
}

.card-favorito {
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
  padding: 16px;
  text-align: center;
  transition: transform 0.2s;
}

.card-favorito:hover {
  transform: translateY(-5px);
}

.card-favorito img {
  max-width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 12px;
}

.card-favorito h3 {
  margin: 0;
  font-size: 18px;
}

.card-favorito p {
  font-size: 14px;
  color: #666;
  margin: 6px 0 12px;
}

.card-favorito .preco {
  font-size: 16px;
  color: #222;
  font-weight: bold;
  margin: 4px 0 12px;
}

.acoes {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.btn-adicionar {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 8px 14px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-adicionar:hover {
  background-color: #388e3c;
}

.btn-remover {
  background-color: #e74c3c;
  color: white;
  border: none;
  padding: 8px 14px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-remover:hover {
  background-color: #c0392b;
}

</style>

<body>
  <header class="cabecalho">
    <h1>Meus Favoritos</h1>
    <a href="inicial.html" class="btn-voltar">← Voltar</a>
  </header>

  <main class="conteudo">
    <section class="grid-favoritos">
      <div class="card-favorito">
        <img src="../images/jairo-zeppelin.png" alt="Livro 1" />
        <h3> Jojo's Bizarre Adventure – Parte 7 – Steel Ball Run 01</h3>
        <p>Autor: Hirohiko Araki </p>
        <p class="preco">Preço: R$ 54,90</p>
        <div class="acoes">
          <button class="btn-adicionar">Adicionar ao Carrinho</button>
          <button class="btn-remover">Remover</button>
        </div>
      </div>

      <div class="card-favorito">
        <img src="../images/batman.png" alt="Livro 2" />
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
