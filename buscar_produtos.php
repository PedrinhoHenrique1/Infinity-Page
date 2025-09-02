<?php
require 'conexao/conexao.php';

// Define o cabeçalho como JSON
header('Content-Type: application/json');

// Pega o ID da categoria da URL. Se for 0 ou não existir, busca todos.
$categoria_id = isset($_GET['categoria_id']) ? (int)$_GET['categoria_id'] : 0;

try {
    if ($categoria_id > 0) {
        // Prepara a consulta para uma categoria específica
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id_categoria = :id_categoria ORDER BY titulo");
        $stmt->execute(['id_categoria' => $categoria_id]);
    } else {
        // Consulta para buscar todos os produtos
        $stmt = $conn->query("SELECT * FROM produtos ORDER BY titulo");
    }
    
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Corrige o caminho da imagem para cada produto antes de enviar
    foreach ($produtos as &$produto) {
        if (!empty($produto['imagem_url'])) {
            // Remove o '../' do caminho da imagem para funcionar corretamente no HTML
            $produto['imagem_url'] = str_replace('../', '', $produto['imagem_url']);
        } else {
            // Define uma imagem padrão caso não haja
            $produto['imagem_url'] = 'images/placeholder.png';
        }
    }

    // Retorna os produtos em formato JSON
    echo json_encode($produtos);

} catch (PDOException $e) {
    // Em caso de erro, retorna uma resposta de erro em JSON
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Erro ao buscar produtos: ' . $e->getMessage()]);
}
?>