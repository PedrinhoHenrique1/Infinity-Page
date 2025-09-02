<?php
session_start();
require 'conexao/conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Sessão expirada.']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$id_produto = $data['id_produto'] ?? null;

if (!$id_produto) {
    echo json_encode(['success' => false, 'message' => 'ID do produto não informado.']);
    exit();
}

$id_cliente = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("DELETE FROM carrinho WHERE id_cliente = :id_cliente AND id_produto = :id_produto");
    $stmt->execute(['id_cliente' => $id_cliente, 'id_produto' => $id_produto]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Produto removido do carrinho.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Produto não encontrado no carrinho.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
?>