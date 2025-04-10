// Menu Lateral
function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function showSection(sectionId) {
    const sections = document.querySelectorAll('main .section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.style.display = 'block';
    }

    toggleMenu();
}

document.addEventListener('DOMContentLoaded', () => {
    showSection('estoque');
});

//Validação de Login
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;

    // Simulação de credenciais válidas
    const usuarios = [
      { email: 'admin@empresa.com', senha: 'admin123', destino: 'admin.html' },
    ];

    const usuario = usuarios.find(user => user.email === email && user.senha === senha);

    if (usuario) {
      window.location.href = usuario.destino;
    } else {
      alert('E-mail ou senha inválidos');
    }
  });

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