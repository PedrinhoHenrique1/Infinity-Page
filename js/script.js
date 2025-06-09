  // LÓGICA DE NAVEGAÇÃO E INTERAÇÃO
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle-btn');
            const sidebar = document.getElementById('sidebar');

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
            
            // Inicia com a primeira seção ativa
            mostrarSecao('estoque', document.querySelector('.nav-link'));
        });

        function mostrarSecao(sectionId, element) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            element.classList.add('active');
        }

        // FUNÇÕES DE GERENCIAMENTO (copiadas do seu script.js)
        
        // Estoque
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
        function editarItem(button) { /* ...Sua lógica de edição... */ }
        function removerItem(button) { button.closest('tr').remove(); }

        // Funcionários
        function adicionarFuncionario(event) {
            event.preventDefault();
            const nome = document.getElementById('nome-func').value;
            const email = document.getElementById('email-func').value;
            const permissao = document.getElementById('permissao-func').value;
            const tabela = document.getElementById('tabela-func').querySelector('tbody');
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
        function editarFuncionario(botao) { /* ...Sua lógica de edição... */ }
        function excluirFuncionario(botao) { botao.closest('tr').remove(); }