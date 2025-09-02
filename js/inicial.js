document.addEventListener("DOMContentLoaded", function() {
    // ---- CONTROLES DA SIDEBAR ----
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // ---- FUNÇÃO PRINCIPAL PARA BUSCAR PRODUTOS ----
    function buscarProdutos(categoriaId = 0) {
        fetch(`buscar_produtos.php?categoria_id=${categoriaId}`)
            .then(response => {
                if (!response.ok) throw new Error('A resposta da rede não foi boa');
                return response.json();
            })
            .then(products => {
                renderizarProdutos(products);
            })
            .catch(error => {
                console.error('Erro ao buscar produtos:', error);
                const container = document.querySelector(".products-container");
                container.innerHTML = "<p>Ocorreu um erro ao carregar os produtos. Tente novamente mais tarde.</p>";
            });
    }
    
    // ---- FUNÇÃO PARA RENDERIZAR PRODUTOS NA TELA ----
    function renderizarProdutos(products) {
        const container = document.querySelector(".products-container");
        container.innerHTML = ""; // Limpa os produtos atuais

        if (products.length > 0) {
            products.forEach(product => {
                const precoFormatado = parseFloat(product.preco).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                const productHTML = `
                    <div class="product" onclick="mostrarDetalhe('detalhe-produto-${product.id_produto}')">
                        <img src="${product.imagem_url}" alt="${product.titulo}">
                        <h3>${product.titulo}</h3>
                        <p>R$ ${precoFormatado}</p>
                        <button class="buy-button">Comprar</button>
                    </div>
                `;
                container.innerHTML += productHTML;
            });
        } else {
            container.innerHTML = "<p>Nenhum produto encontrado para esta categoria.</p>";
        }
    }

    // ---- EVENT LISTENERS PARA OS FILTROS DE CATEGORIA ----
    document.querySelectorAll(".dc-button[data-category-id]").forEach(button => {
        button.addEventListener("click", function() {
            // Remove a classe 'active' do botão que estava ativo
            const currentActive = document.querySelector('.dc-button.active');
            if (currentActive) {
                currentActive.classList.remove('active');
            }
            
            // Adiciona a classe 'active' ao botão clicado
            this.classList.add('active');
            
            const categoriaId = this.getAttribute("data-category-id");
            document.getElementById('titulo-categoria').textContent = this.textContent.trim();
            buscarProdutos(categoriaId);
        });
    });
    
    // ---- CARGA INICIAL DOS PRODUTOS (TODOS) ----
    buscarProdutos();
});

// ---- FUNÇÕES PARA DETALHES DO PRODUTO ----
function mostrarDetalhe(id) {
    document.getElementById("conteudo-principal").style.display = "none";
    document.getElementById("detalhes-container").style.display = "block";

    document.querySelectorAll(".produto-detalhe").forEach(d => d.style.display = "none");

    const detalheSelecionado = document.getElementById(id);
    if (detalheSelecionado) {
        detalheSelecionado.style.display = "block";
    }
}

function voltarParaHome() {
    document.getElementById("conteudo-principal").style.display = "block";
    document.getElementById("detalhes-container").style.display = "none";
}

// ---- FUNÇÃO PARA A BARRA DE BUSCA ----
function filtrarItens() {
    const termo = document.getElementById("buscaItem").value.toLowerCase();
    document.querySelectorAll(".product").forEach(item => {
        const nomeItem = item.querySelector("h3").textContent.toLowerCase();
        item.style.display = nomeItem.includes(termo) ? "flex" : "none";
    });
}

// ---- FUNÇÃO PARA ADICIONAR AO CARRINHO ----
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('add-to-cart-btn')) {
        const idProduto = event.target.getAttribute('data-id');
        const quantidadeInput = document.getElementById(`quantidade-${idProduto}`);
        const quantidade = quantidadeInput ? parseInt(quantidadeInput.value) : 1;

        fetch('adicionar_carrinho.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id_produto: idProduto,
                    quantidade: quantidade
                }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Exibe uma mensagem de sucesso ou erro
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Ocorreu um erro ao adicionar o produto ao carrinho.');
            });
    }
});