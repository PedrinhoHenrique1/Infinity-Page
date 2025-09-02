document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    const navLinks = document.querySelectorAll('.nav-link[data-section]');
    navLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const sectionId = link.getAttribute('data-section');
            mostrarSecao(sectionId, link);
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    });

    const ativoInicial = document.querySelector('.nav-link.active[data-section]');
    if (ativoInicial) {
        mostrarSecao(ativoInicial.getAttribute('data-section'), ativoInicial);
    }
});

function mostrarSecao(sectionId, element) {
    document.querySelectorAll('.section').forEach(secao => secao.classList.remove('active'));
    const secao = document.getElementById(sectionId);
    if (secao) {
        secao.classList.add('active');
    }
    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
    if (element) {
        element.classList.add('active');
    }
}

// Funções para o Modal de Edição de Livros
function abrirModalEdicao(id, titulo, autor, quantidade, preco) {
    document.getElementById('edit-id-produto').value = id;
    document.getElementById('edit-nome-livro').value = titulo;
    document.getElementById('edit-autor-livro').value = autor;
    document.getElementById('edit-quantidade').value = quantidade;
    document.getElementById('edit-preco').value = preco;
    document.getElementById('modal-edicao').style.display = 'block';
}

function fecharModalEdicao() {
    document.getElementById('modal-edicao').style.display = 'none';
}

// FUNCIONÁRIOS (código existente)
function adicionarFuncionario(event) {
    event.preventDefault();
    const nome = document.getElementById('nome-func').value.trim();
    const email = document.getElementById('email-func').value.trim();
    const permissao = document.getElementById('permissao-func').value;

    if (!nome || !email || !permissao) {
        alert('Preencha todos os campos!');
        return;
    }

    const tabela = document.getElementById('tabela-func');
    const novaLinha = tabela.insertRow();
    novaLinha.innerHTML = `
        <td>${nome}</td>
        <td>${email}</td>
        <td>${permissao}</td>
        <td class="actions">
            <button class="btn-edit" onclick="editarFuncionario(this)">Editar</button>
            <button class="btn-delete" onclick="excluirFuncionario(this)">Excluir</button>
        </td>
    `;
    event.target.reset();
}

function editarFuncionario(botao) {
    // Lógica de edição para funcionários
}

function excluirFuncionario(botao) {
    botao.closest('tr').remove();
}