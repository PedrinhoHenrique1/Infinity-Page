//Menu Lateral
function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    const activeSection = document.getElementById(sectionId);
    activeSection.style.display = 'block';

    toggleMenu();
}


document.addEventListener('DOMContentLoaded', () => {
    showSection('estoque');
});
//Estoque
function adicionarItem(event) {
    event.preventDefault();

    const nomeLivro = document.getElementById('nome-livro').value;
    const autorLivro = document.getElementById('autor-livro').value;
    const quantidade = document.getElementById('quantidade').value;
    const preco = document.getElementById('preco').value;

    const tabela = document.getElementById('tabela-estoque');
    const novaLinha = tabela.insertRow();

    novaLinha.insertCell(0).innerText = nomeLivro;
    novaLinha.insertCell(1).innerText = autorLivro;
    novaLinha.insertCell(2).innerText = quantidade;
    novaLinha.insertCell(3).innerText = `R$ ${parseFloat(preco).toFixed(2)}`;

    const acoesCell = novaLinha.insertCell(4);
    const editarButton = document.createElement('button');
    editarButton.innerText = 'Editar';
    editarButton.onclick = function() { editarItem(editarButton); };
    acoesCell.appendChild(editarButton);

    const removerButton = document.createElement('button');
    removerButton.innerText = 'Remover';
    removerButton.onclick = function() { removerItem(removerButton); };
    acoesCell.appendChild(removerButton);

    document.getElementById('form-estoque').reset();
}

function editarItem(button) {
    const row = button.closest('tr');
    const nomeLivro = row.cells[0].innerText;
    const autorLivro = row.cells[1].innerText;
    const quantidade = row.cells[2].innerText;
    const preco = row.cells[3].innerText.replace('R$ ', '');

    alert(`Editar: ${nomeLivro}, Autor: ${autorLivro}, Quantidade: ${quantidade}, Preço: R$ ${preco}`);
}

function removerItem(button) {
    const row = button.closest('tr');
    row.remove();
    alert('Item removido com sucesso!');
}
//Funcionários
document.getElementById('form-funcionario').addEventListener('submit', function(event) {
    event.preventDefault();

    const nome = document.getElementById('nome-funcionario').value;
    const cargo = document.getElementById('cargo').value;
    const email = document.getElementById('email').value;
    const telefone = document.getElementById('telefone').value;

    fetch('/funcionarios', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nome, cargo, email, telefone })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            adicionarFuncionarioNaTabela(data.funcionario);
            document.getElementById('form-funcionario').reset();
        } else {
            alert('Erro ao adicionar funcionário: ' + data.message);
        }
    });
});

function adicionarFuncionarioNaTabela(funcionario) {
    const tabela = document.getElementById('tabela-funcionarios').getElementsByTagName('tbody')[0];
    const novaLinha = tabela.insertRow();

    novaLinha.insertCell(0).innerText = funcionario.nome;
    novaLinha.insertCell(1).innerText = funcionario.cargo;
    novaLinha.insertCell(2).innerText = funcionario.email;
    novaLinha.insertCell(3).innerText = funcionario.telefone;

    const acoesCell = novaLinha.insertCell(4);
    const removerButton = document.createElement('button');
    removerButton.innerText = 'Remover';
    removerButton.onclick = function() {
        removerFuncionario(funcionario.id, novaLinha);
    };
    acoesCell.appendChild(removerButton);
}

function removerFuncionario(id, linha) {
    fetch(`/funcionarios/${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            linha.remove();
        } else {
            alert('Erro ao remover funcionário: ' + data.message);
        }
    });
}