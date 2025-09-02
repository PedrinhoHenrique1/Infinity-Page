document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('pagamento-modal');
    const fecharBtn = document.querySelector('.fechar-modal');

    // Função para abrir o modal
    function abrirModal() {
        // Aqui você pode adicionar lógica para buscar os itens do carrinho e preencher o resumo
        modal.style.display = 'block';
    }

    // Função para fechar o modal
    function fecharModal() {
        modal.style.display = 'none';
    }

    // Evento para fechar no 'x'
    if (fecharBtn) {
        fecharBtn.onclick = fecharModal;
    }

    // Evento para fechar clicando fora
    window.onclick = function(event) {
        if (event.target == modal) {
            fecharModal();
        }
    }

    // Adiciona evento de clique aos botões "Comprar"
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('buy-button')) {
            abrirModal();
        }
    });

       const formPagamento = document.getElementById('form-pagamento-modal');
    if (formPagamento) {
        formPagamento.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('processar_pagamento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                // Você pode enviar os dados do formulário se precisar (ex: dados do cartão)
                // body: JSON.stringify({ ...dados... }) 
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Exibe a mensagem de sucesso ou erro
                if (data.success) {
                    fecharModal();
                    // Opcional: atualizar a página ou redirecionar o usuário
                    // window.location.href = 'meus_pedidos.php'; 
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao processar seu pagamento.');
            });
        });
    }
});