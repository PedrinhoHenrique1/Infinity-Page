<?php
session_start();
require 'conexao/conexao.php';

header('Content-Type: application/json');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para adicionar itens ao carrinho.']);
    exit();
}

// Pega os dados da requisição
$data = json_decode(file_get_contents('php://input'), true);
$id_produto = $data['id_produto'] ?? null;
$quantidade = $data['quantidade'] ?? 1;

if (!$id_produto) {
    echo json_encode(['success' => false, 'message' => 'ID do produto não fornecido.']);
    exit();
}

$id_cliente = $_SESSION['user_id'];

try {
    // Verifica se o produto já está no carrinho
    $stmt_check = $conn->prepare("SELECT * FROM carrinho WHERE id_cliente = :id_cliente AND id_produto = :id_produto");
    $stmt_check->execute(['id_cliente' => $id_cliente, 'id_produto' => $id_produto]);
    $item_existente = $stmt_check->fetch();

    if ($item_existente) {
        // Se já existe, atualiza a quantidade
        $nova_quantidade = $item_existente['quantidade'] + $quantidade;
        $stmt_update = $conn->prepare("UPDATE carrinho SET quantidade = :quantidade WHERE id_carrinho = :id_carrinho");
        $stmt_update->execute(['quantidade' => $nova_quantidade, 'id_carrinho' => $item_existente['id_carrinho']]);
    } else {
        // Se não existe, insere um novo item
        $stmt_insert = $conn->prepare("INSERT INTO carrinho (id_cliente, id_produto, quantidade) VALUES (:id_cliente, :id_produto, :quantidade)");
        $stmt_insert->execute(['id_cliente' => $id_cliente, 'id_produto' => $id_produto, 'quantidade' => $quantidade]);
    }

    echo json_encode(['success' => true, 'message' => 'Produto adicionado ao carrinho!']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
?>