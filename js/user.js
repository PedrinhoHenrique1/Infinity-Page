        // envio do formulário
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();
        
            const usuarios = [
                { email: 'admin@infinity.com', senha: 'admin123', tipo: 'admin' },
                { email: 'cliente@email.com', senha: 'cliente123', tipo: 'user' }
            ];

        
            const emailDigitado = document.getElementById('email').value;
            const senhaDigitada = document.getElementById('senha').value;
            const errorMessage = document.getElementById('error-message');

            // Procura o usuário na simulação da nossa lista
            const usuarioEncontrado = usuarios.find(u => u.email === emailDigitado && u.senha === senhaDigitada);

            // Verifica se um usuário foi encontrado
            if (usuarioEncontrado) {
               ''
                errorMessage.style.display = 'none';
                
                // Guarda no navegador a informação de quem logou 
                localStorage.setItem('usuarioLogado', JSON.stringify({
                    email: usuarioEncontrado.email,
                    tipo: usuarioEncontrado.tipo
                }));

                // REDIRECIONA de acordo com o tipo de usuário
                if (usuarioEncontrado.tipo === 'admin') {
                    alert('Login de Administrador bem-sucedido! Redirecionando...');
                    window.location.href = 'admin.php'; // Manda para a página de admin
                } else {
                    alert('Login bem-sucedido! Bem-vindo(a)!');
                    window.location.href = 'inicial.php'; // Manda para a página inicial da loja
                }

            } else {
                // Se não encontrou um usuário correspondente, mostra a mensagem de erro
                errorMessage.style.display = 'block';
            }
        });