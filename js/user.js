        // Adiciona um "escutador" para o evento de envio do formulário
        document.getElementById('login-form').addEventListener('submit', function(event) {
            // Previne o comportamento padrão do formulário (que recarregaria a página)
            event.preventDefault();

            // 1. Simulação de um banco de dados de usuários
            // No futuro, isso seria uma chamada para o seu backend (server.js)
            const usuarios = [
                { email: 'admin@infinity.com', senha: 'admin123', tipo: 'admin' },
                { email: 'cliente@email.com', senha: 'cliente123', tipo: 'user' }
                // Adicione mais usuários aqui se precisar para testes
            ];

            // 2. Pega os valores que o usuário digitou nos campos
            const emailDigitado = document.getElementById('email').value;
            const senhaDigitada = document.getElementById('senha').value;
            const errorMessage = document.getElementById('error-message');

            // 3. Procura o usuário na nossa lista simulada
            const usuarioEncontrado = usuarios.find(u => u.email === emailDigitado && u.senha === senhaDigitada);

            // 4. Verifica se um usuário foi encontrado
            if (usuarioEncontrado) {
                // Se encontrou, esconde qualquer mensagem de erro que esteja visível
                errorMessage.style.display = 'none';
                
                // Guarda no navegador a informação de quem logou (para usar em outras páginas)
                localStorage.setItem('usuarioLogado', JSON.stringify({
                    email: usuarioEncontrado.email,
                    tipo: usuarioEncontrado.tipo
                }));

                // 5. REDIRECIONA de acordo com o tipo de usuário
                if (usuarioEncontrado.tipo === 'admin') {
                    alert('Login de Administrador bem-sucedido! Redirecionando...');
                    window.location.href = 'admin.html'; // Manda para a página de admin
                } else {
                    alert('Login bem-sucedido! Bem-vindo(a)!');
                    window.location.href = 'inicial.html'; // Manda para a página inicial da loja
                }

            } else {
                // Se não encontrou um usuário correspondente, mostra a mensagem de erro
                errorMessage.style.display = 'block';
            }
        });