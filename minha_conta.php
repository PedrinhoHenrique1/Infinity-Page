<?php
session_start();
require 'conexao/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Obtém o ID do cliente da sessão
$id_cliente = $_SESSION['user_id'];

try {
    // Busca as informações do cliente no banco de dados
    $stmt_cliente = $conn->prepare("SELECT * FROM clientes WHERE id_cliente = :id_cliente");
    $stmt_cliente->execute(['id_cliente' => $id_cliente]);
    $cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);

    // Busca o histórico de pedidos do cliente
    $stmt_pedidos = $conn->prepare("SELECT * FROM pedidos WHERE id_cliente = :id_cliente ORDER BY data_pedido DESC");
    $stmt_pedidos->execute(['id_cliente' => $id_cliente]);
    $pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Em caso de erro, exibe uma mensagem
    die("Erro ao buscar informações: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - Infinity Page</title>
    <link rel="stylesheet" href="css/minha_conta.css">
</head>

<body>

    <header>
        <h1>Minha Conta</h1>
    </header>

    <section id="informacoes-conta">
        <h2>Informações da Conta</h2>
        <?php if ($cliente) : ?>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($cliente['nome']); ?></p>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($cliente['email']); ?></p>
            <button onclick="window.location.href='editar_informacoes.php'"> Editar Informações </button>
        <?php else : ?>
            <p>Não foi possível carregar as informações do usuário.</p>
        <?php endif; ?>
    </section>

    <section id="historico-pedidos">
        <h2>Histórico de Pedidos</h2>
        <ul>
            <?php if ($pedidos) : ?>
                <?php foreach ($pedidos as $pedido) : ?>
                    <li>
                        <h3>Pedido #<?php echo $pedido['id_pedido']; ?></h3>
                        <p>Data: <?php echo date('d/m/Y', strtotime($pedido['data_pedido'])); ?></p>
                        <p>Status: <span class="status status-<?php echo strtolower(str_replace(' ', '-', $pedido['status_pedido'])); ?>"><?php echo htmlspecialchars($pedido['status_pedido']); ?></span></p>
                        <p>Total: R$ <?php echo number_format($pedido['total_pedido'], 2, ',', '.'); ?></p>
                        <button onclick="window.location.href='pedidos.php?id=<?php echo $pedido['id_pedido']; ?>'">Ver Detalhes</button>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Você ainda não fez nenhum pedido.</p>
            <?php endif; ?>
        </ul>
    </section>

    <section id="voltar">
        <button onclick="window.location.href='inicial.php'"> Voltar </button>
    </section>
</body>
</html>