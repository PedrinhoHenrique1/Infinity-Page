<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinity Page - Troca de Livros</title>
    <link rel="stylesheet" href="css/trocas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/trocas.css">
</head>



<body>
    <!-- Cabeçalho -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Infinity Page Logo" width="150px">
        </div>
    </header>

    <a href="javascript:history.back()" class="botao-voltar">← Voltar</a>

    <main>
        <!-- Cabeçalho da Página -->
        <section class="troca-header">
            <h1>Troque seus Livros Usados</h1>
            <p>Envie seus livros antigos e ganhe descontos na compra de novos!</p>
        </section>

        <!-- Formulário de Envio de Livro -->
        <section class="envio-livro">
            <h2>Envie seu Livro</h2>
            <form id="form-envio-livro">
                <div class="form-group">
                    <label for="titulo-livro">Título do Livro:</label>
                    <input type="text" id="titulo-livro" name="titulo-livro" placeholder="Ex: O Senhor dos Anéis"
                        required>
                </div>

                <div class="form-group">
                    <label for="autor-livro">Autor:</label>
                    <input type="text" id="autor-livro" name="autor-livro" placeholder="Ex: J.R.R. Tolkien" required>
                </div>

                <div class="form-group">
                    <label for="estado-livro">Estado do Livro:</label>
                    <select id="estado-livro" name="estado-livro" required>
                        <option value="" disabled selected>Selecione o estado</option>
                        <option value="novo">Novo</option>
                        <option value="bom">Bom</option>
                        <option value="usado">Usado</option>
                        <option value="danificado">Danificado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao-livro">Descrição:</label>
                    <textarea id="descricao-livro" name="descricao-livro" rows="4"
                        placeholder="Descreva o estado do livro..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="fotos-livro">Adicione Fotos do Livro:</label>
                    <input type="file" id="fotos-livro" name="fotos-livro" multiple accept="image/*">
                    <div class="preview-container" id="preview-container">
                        <!-- Pré-visualização das imagens enviadas -->
                    </div>
                </div>

                <button type="submit" class="submit-btn">Enviar Livro</button>
            </form>
        </section>

        <!-- Livros Disponíveis para Compra -->
        <section class="livros-disponiveis">
            <h2>Livros Disponíveis para Compra</h2>
            <div class="books-container">
                <div class="book">
                    <img src="images/harry-filosofal.png" alt="Harry Potter e a Pedra Filosofal">
                    <h3>Harry Potter e a Pedra Filosofal</h3>
                    <p>R$ 39,90 <span class="desconto">-20% com troca</span></p>
                    <button class="buy-button">Comprar</button>
                </div>
                <div class="book">
                    <img src="images/one-piece-vol.1.png" alt="One Piece Vol. 1">
                    <h3>One Piece Vol. 1</h3>
                    <p>R$ 29,90 <span class="desconto">-15% com troca</span></p>
                    <button class="buy-button">Comprar</button>
                </div>
                <div class="book">
                    <img src="images/sherlock-holmes.png" alt="Sherlock Holmes">
                    <h3>Sherlock Holmes</h3>
                    <p>R$ 49,90 <span class="desconto">-10% com troca</span></p>
                    <button class="buy-button">Comprar</button>
                </div>
            </div>
        </section>

        <!-- Histórico de Trocas -->
        <section class="historico-trocas">
            <h2>Histórico de Trocas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Livro Enviado</th>
                        <th>Estado</th>
                        <th>Desconto Obtido</th>
                        <th>Data da Troca</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>O Senhor dos Anéis</td>
                        <td>Bom</td>
                        <td>20%</td>
                        <td>10/04/2025</td>
                    </tr>
                    <tr>
                        <td>Dom Quixote</td>
                        <td>Usado</td>
                        <td>15%</td>
                        <td>05/04/2025</td>
                    </tr>
                    <tr>
                        <td>A Arte da Guerra</td>
                        <td>Danificado</td>
                        <td>10%</td>
                        <td>01/04/2025</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Infinity Page. Todos os direitos reservados.</p>
    </footer>

    <script>
        const inputFotos = document.getElementById("fotos-livro");
        const previewContainer = document.getElementById("preview-container");

        inputFotos.addEventListener("change", () => {
            previewContainer.innerHTML = ""; // Limpa a pré-visualização anterior
            const arquivos = inputFotos.files;

            if (arquivos) {
                Array.from(arquivos).forEach((arquivo) => {
                    const leitor = new FileReader();

                    leitor.onload = (e) => {
                        const img = document.createElement("img");
                        img.src = e.target.result; // Define a URL da imagem
                        previewContainer.appendChild(img);
                    };

                    leitor.readAsDataURL(arquivo); // Lê a imagem como URL
                });
            }
        });

        document.getElementById("form-envio-livro").addEventListener("submit", (event) => {
            event.preventDefault();
            alert("Seu livro e as fotos foram enviados para análise! Você será notificado sobre o desconto.");
            inputFotos.value = ""; // Limpa o campo de upload
            previewContainer.innerHTML = ""; // Limpa a pré-visualização
        });
    </script>
</body>

</html>