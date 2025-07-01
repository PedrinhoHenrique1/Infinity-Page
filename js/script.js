document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('toggle-btn');
  const sidebar = document.getElementById('sidebar');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const navLinks = document.querySelectorAll('.nav-link[data-section]');
  const sidebar = document.getElementById('sidebar');

  navLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      const sectionId = link.getAttribute('data-section');
      mostrarSecao(sectionId, link);

      // Fecha o menu lateral 
      if (sidebar.classList.contains('active')) {
        sidebar.classList.remove('active');
      }
    });
  });

  // Mostra o estoque
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

// ESTOQUE
function adicionarItem(event) {
    event.preventDefault();
    const nomeLivro = document.getElementById('nome-livro').value;
    const autorLivro = document.getElementById('autor-livro').value;
    const quantidade = document.getElementById('quantidade').value;
    const preco = parseFloat(document.getElementById('preco').value);
    const tabela = document.getElementById('tabela-estoque');
    const novaLinha = tabela.insertRow();
    novaLinha.innerHTML = `
        <td>${nomeLivro}</td>
        <td>${autorLivro}</td>
        <td>${quantidade}</td>
        <td>R$ ${preco.toFixed(2)}</td>
        <td class="actions">
            <button class="btn-edit" onclick="editarItem(this)">Editar</button>
            <button class="btn-delete" onclick="removerItem(this)">Remover</button>
        </td>
    `;
    document.getElementById('form-estoque').reset();
}

function editarItem(button) {
    
}

function removerItem(button) {
    button.closest('tr').remove();
}

// FUNCIONÁRIOS
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

    // Limpar o formulário
    event.target.reset();
}

function editarFuncionario(botao) {
    // Sua lógica de edição aqui
}

function excluirFuncionario(botao) {
    botao.closest('tr').remove();
}
