<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - Infinity Page</title>
</head>
    <style>
        /* === RESET BÁSICO E ESTILOS GLOBAIS === */
        :root {
            --primary-dark: #1e1f3b;
            --primary-light: #4d6ac5;
            --background-color: #f4f7f9;
            --card-background: #ffffff;
            --text-color: #333;
            --text-light: #666;
            --border-color: #e9eef2;
            --status-entregue: #28a745;
            --status-transito: #ffc107;
            --status-cancelado: #dc3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
        }

        /* === CONTAINER PRINCIPAL === */
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        /* === CABEÇALHO DA PÁGINA === */
        header h1 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 30px;
        }
        
        /* === CARD DE INFORMAÇÕES === */
        #informacoes-conta {
            background-color: var(--card-background);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        #informacoes-conta h2 {
            margin-top: 0;
            color: var(--primary-dark);
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        #informacoes-conta p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-light);
        }

        #informacoes-conta p strong {
            color: var(--text-color);
        }

        /* === ESTILO DOS BOTÕES === */
        button {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        #informacoes-conta button {
            background-color: var(--primary-light);
            color: white;
            margin-top: 15px;
        }
        
        /* === HISTÓRICO DE PEDIDOS === */
        #historico-pedidos h2 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
        }

        #historico-pedidos ul {
            list-style: none;
            padding: 0;
        }

        #historico-pedidos li {
            background-color: var(--card-background);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Para responsividade em telas menores */
            gap: 15px;
        }

        #historico-pedidos h3 {
            margin: 0;
            font-size: 1.2rem;
            flex-basis: 100%; /* Ocupa a linha toda */
            margin-bottom: 15px;
        }

        #historico-pedidos p {
            margin: 0;
            color: var(--text-light);
        }
        
        /* === STATUS DOS PEDIDOS COM CORES === */
        .status {
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            color: white;
            font-size: 0.9rem;
        }
        .status-entregue { background-color: var(--status-entregue); }
        .status-transito { background-color: var(--status-transito); }
        .status-cancelado { background-color: var(--status-cancelado); }

        #historico-pedidos button {
            background-color: transparent;
            color: var(--primary-light);
            border: 2px solid var(--primary-light);
            font-weight: 600;
        }
        
        /* === BOTÃO DE VOLTAR === */
        #voltar {
            text-align: center;
            margin-top: 40px;
        }

        #voltar button {
            background-color: #6c757d;
            color: white;
        }

    </style>
<body>

    <header>
        <h1>Minha Conta</h1>
    </header>

    <section id="informacoes-conta">
        <h2>Informações da Conta</h2>
        <p><strong>Nome:</strong> João da Silva</p>
        <p><strong>E-mail:</strong> joao.silva@email.com</p>
        <button onclick="editar()"> Editar Informações </button>
    </section>

    <section id="historico-pedidos">
        <h2>Histórico de Pedidos</h2>
        <ul>
            <li>
                <h3>Pedido #12345</h3>
                <p>Data: 01/10/2023</p>
                <p>Status: Entregue</p>
                <p>Total: R$ 89,90</p>
                <button>Ver Detalhes</button>
            </li>
            <li>
                <h3>Pedido #12346</h3>
                <p>Data: 15/09/2023</p>
                <p>Status: Em Trânsito</p>
                <p>Total: R$ 49,90</p>
                <button>Ver Detalhes</button>
            </li>
            <li>
                <h3>Pedido #12347</h3>
                <p>Data: 05/09/2023</p>
                <p>Status: Cancelado</p>
                <p>Total: R$ 34,90</p>
                <button>Ver Detalhes</button>
            </li>
        </ul>
    </section>

    <section id="voltar">
        <button onclick="window.location.href='inicial.html'"> Voltar </button>
    </section>
</body>
</html>