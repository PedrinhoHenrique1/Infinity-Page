window.onload = () => {
    showSection('estoque');
};

function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function showSection(sectionId) {
    const sections = document.querySelectorAll('main > section');
    sections.forEach(section => {
        section.style.display = section.id === sectionId ? 'block' : 'none';
    });
}

// Estoque
function adicionarItem(event) {
    event.preventDefault();

    const nomeLivro = document.getElementById('nome-livro').value;
    const autorLivro = document.getElementById('autor-livro').value;
    const quantidade = document.getElementById('quantidade').value;
    const preco = document.getElementById('preco').value;

    const tabela = document.getElementById('tabela-estoque');
    const novaLinha = tabela.insertRow();

    novaLinha.innerHTML = `
        <td>${nomeLivro}</td>
        <td>${autorLivro}</td>
        <td>${quantidade}</td>
        <td>R$ ${parseFloat(preco).toFixed(2)}</td>
        <td>
            <button onclick="editarItem(this)">Editar</button>
            <button onclick="removerItem(this)">Remover</button>
        </td>
    `;

    document.getElementById('form-estoque').reset();
}

function editarItem(button) {
    const row = button.closest('tr');
    const nome = row.cells[0].textContent;
    const autor = row.cells[1].textContent;
    const quantidade = row.cells[2].textContent;
    const preco = row.cells[3].textContent.replace('R$ ', '');

    const novoNome = prompt("Editar Nome do Livro:", nome);
    const novoAutor = prompt("Editar Autor:", autor);
    const novaQuantidade = prompt("Editar Quantidade:", quantidade);
    const novoPreco = prompt("Editar Preço:", preco);

    if (novoNome && novoAutor && novaQuantidade && novoPreco) {
        row.cells[0].textContent = novoNome;
        row.cells[1].textContent = novoAutor;
        row.cells[2].textContent = novaQuantidade;
        row.cells[3].textContent = `R$ ${parseFloat(novoPreco).toFixed(2)}`;
    }
}

function removerItem(button) {
    const row = button.closest('tr');
    row.remove();
    alert('Item removido com sucesso!');
}


// Funcionários
function adicionarFuncionario(event) {
    event.preventDefault();

    const nome = document.getElementById('nome-func').value;
    const email = document.getElementById('email-func').value;
    const permissao = document.getElementById('permissao-func').value;

    const tabela = document.getElementById('tabela-func');
    const novaLinha = document.createElement('tr');

    novaLinha.innerHTML = `
        <td>${nome}</td>
        <td>${email}</td>
        <td>${permissao}</td>
        <td>
            <button class="btn-acao-func" onclick="editarFuncionario(this)">Editar</button>
            <button class="btn-acao-func" onclick="excluirFuncionario(this)">Excluir</button>
        </td>
    `;

    tabela.appendChild(novaLinha);
    event.target.reset();
}

function editarFuncionario(botao) {
    const linha = botao.closest('tr');

    if (botao.textContent === 'Editar') {
        const nome = linha.children[0].textContent;
        const email = linha.children[1].textContent;
        const permissao = linha.children[2].textContent;

        linha.children[0].innerHTML = `<input type="text" value="${nome}">`;
        linha.children[1].innerHTML = `<input type="email" value="${email}">`;
        linha.children[2].innerHTML = `
            <select>
                <option value="admin" ${permissao === 'Administrador' ? 'selected' : ''}>Administrador</option>
                <option value="func" ${permissao === 'Funcionário' ? 'selected' : ''}>Funcionário</option>
            </select>
        `;

        botao.textContent = 'Salvar';
    } else {
        const novoNome = linha.children[0].querySelector('input').value;
        const novoEmail = linha.children[1].querySelector('input').value;
        const novaPermissao = linha.children[2].querySelector('select').value;

        linha.children[0].textContent = novoNome;
        linha.children[1].textContent = novoEmail;
        linha.children[2].textContent = novaPermissao;

        botao.textContent = 'Editar';
    }
}

function excluirFuncionario(botao) {
    const linha = botao.closest('tr');
    linha.remove();
}

//Registro de Produtos
let editandoProduto = null;

function adicionarProduto(event) {
    event.preventDefault();

    const nome = document.getElementById("nome-prod").value;
    const preco = document.getElementById("preco-prod").value;
    const categoria = document.getElementById("categoria-prod").value;

    if (!nome || !preco || !categoria) return;

    if (editandoProduto) {
        // Atualiza os dados na linha existente
        editandoProduto.cells[0].innerText = nome;
        editandoProduto.cells[1].innerText = preco;
        editandoProduto.cells[2].innerText = categoria;
        editandoProduto = null;
    } else {
        // Cria uma nova linha
        const tabela = document.getElementById("tabela-prod");
        const novaLinha = tabela.insertRow();

        novaLinha.innerHTML = `
            <td>${nome}</td>
            <td>${preco}</td>
            <td>${categoria}</td>
            <td>
                <button class="btn-acao-produto" onclick="editarProduto(this)">Editar</button>
                <button class="btn-acao-produto" onclick="excluirProduto(this)">Excluir</button>
            </td>
        `;
    }

    // Limpa o formulário
    document.getElementById("form-produto").reset();
}

function editarProduto(botao) {
    const linha = botao.parentElement.parentElement;
    const nome = linha.cells[0].innerText;
    const preco = linha.cells[1].innerText;
    const categoria = linha.cells[2].innerText;

    document.getElementById("nome-prod").value = nome;
    document.getElementById("preco-prod").value = preco;
    document.getElementById("categoria-prod").value = categoria;

    editandoProduto = linha;
}

function excluirProduto(botao) {
    const linha = botao.parentElement.parentElement;
    linha.remove();

    if (editandoProduto === linha) {
        document.getElementById("form-produto").reset();
        editandoProduto = null;
    }
}

window.onload = () => {
    mostrarSecao('estoque');
  };

function mostrarSecao(id) {
    const secoes = document.querySelectorAll("section");
    secoes.forEach(secao => secao.classList.remove("active"));

    const secaoSelecionada = document.getElementById(id);
    if (secaoSelecionada) {
      secaoSelecionada.classList.add("active");
    }
  }

document.getElementById("login-form").addEventListener("submit", function (e) {
    switch (usuarioLogado.tipo) {
        case 'funcionario':
            sidebar.innerHTML = `
                <li><a href="caixa.html"><i class="fas fa-cash-register"></i> Área do Caixa</a></li>
                <li><a href="index.html"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            `;
          
            if (!window.location.pathname.includes('estoque') &&
                !window.location.pathname.includes("index.html")) {
                window.location.href = "caixa.html";
            }
            break;

        case 'admin':
            sidebar.innerHTML = `
                <li><a href="garcom.html"><i class="fas fa-utensils"></i> Área do Garçom</a></li>
                <li><a href="caixa.html"><i class="fas fa-cash-register"></i> Área do Caixa</a></li>
                <li><a href="relatorio.html"><i class="fas fa-chart-line"></i> Relatórios</a></li>
                <li><a href="estoque.html"><i class="fas fa-boxes"></i> Estoque</a></li>
                <li><a href="configuracoes.html"><i class="fas fa-cog"></i> Configurações</a></li>
                <li><a href="usuario.html"><i class="fa-solid fa-users"></i> Usuários</a></li>
                <li><a href="index.html"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            `;
            break;

        default:
            // Se o tipo de usuário não for reconhecido, redireciona para o login
            window.location.href = "index.html";
            break;
    }

  });