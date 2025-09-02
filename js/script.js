document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    const navLinks = document.querySelectorAll('.nav-link[data-section]');
    navLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const sectionId = link.getAttribute('data-section');

            // Oculta todas as seções
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });

            // Mostra a seção clicada
            const activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.style.display = 'block';
            }

            // Atualiza a classe 'active' no menu
            navLinks.forEach(nav => nav.classList.remove('active'));
            link.classList.add('active');

            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    });

    // Garante que a seção de estoque seja exibida por padrão ao carregar
    if (document.getElementById('estoque')) {
        document.getElementById('estoque').style.display = 'block';
    }
    if (document.getElementById('funcionarios')) {
        document.getElementById('funcionarios').style.display = 'none';
    }
});

// Funções para o Modal de Edição de Livros
function abrirModalEdicao(livro) {
    const modal = document.getElementById('modal-edicao');
    if (modal) {
        // Preenche os campos do formulário no modal com os dados do livro
        document.getElementById('id_produto_edit').value = livro.id_produto;
        document.getElementById('titulo_edit').value = livro.titulo;
        document.getElementById('autor_edit').value = livro.autor;
        document.getElementById('descricao_edit').value = livro.descricao;
        document.getElementById('preco_edit').value = livro.preco;
        document.getElementById('estoque_edit').value = livro.quantidade_estoque;
        document.getElementById('categoria_edit').value = livro.id_categoria;
        document.getElementById('editora_edit').value = livro.editora;
        document.getElementById('idioma_edit').value = livro.idioma;
        document.getElementById('encadernacao_edit').value = livro.encadernacao;
        document.getElementById('paginas_edit').value = livro.numero_paginas;
        document.getElementById('lancamento_edit').value = livro.data_lancamento;
        modal.style.display = 'block';
    }
}

function fecharModalEdicao() {
    const modal = document.getElementById('modal-edicao');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Fecha o modal se o usuário clicar fora dele
window.onclick = function(event) {
    const modal = document.getElementById('modal-edicao');
    if (event.target == modal) {
        fecharModalEdicao();
    }
}