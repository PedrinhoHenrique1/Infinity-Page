<?php
session_start();
require 'conexao/conexao.php'; // Inclui a conexão com o banco de dados

// Verifica se o usuário está logado e é um Administrador
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Administrador') {
    header('Location: login.php');
    exit();
}

$error_message = '';
$success_message = '';

// Lógica para Adicionar Livro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $imagem_url = $_POST['imagem_url'];
    $id_categoria = $_POST['id_categoria'];
    $editora = $_POST['editora'];
    $idioma = $_POST['idioma'];
    $encadernacao = $_POST['encadernacao'];
    $numero_paginas = $_POST['numero_paginas'];
    $data_lancamento = $_POST['data_lancamento'];

    try {
        $sql = "INSERT INTO produtos (titulo, autor, descricao, preco, quantidade_estoque, imagem_url, id_categoria, editora, idioma, encadernacao, numero_paginas, data_lancamento) VALUES (:titulo, :autor, :descricao, :preco, :quantidade_estoque, :imagem_url, :id_categoria, :editora, :idioma, :encadernacao, :numero_paginas, :data_lancamento)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'descricao' => $descricao,
            'preco' => $preco,
            'quantidade_estoque' => $quantidade_estoque,
            'imagem_url' => $imagem_url,
            'id_categoria' => $id_categoria,
            'editora' => $editora,
            'idioma' => $idioma,
            'encadernacao' => $encadernacao,
            'numero_paginas' => $numero_paginas,
            'data_lancamento' => $data_lancamento
        ]);
        $success_message = "Livro adicionado com sucesso!";
    } catch (PDOException $e) {
        $error_message = "Erro ao adicionar livro: " . $e->getMessage();
    }
}

// Lógica para Editar Livro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_book'])) {
    $id = $_POST['id_produto'];
    $titulo = $_POST['edit_titulo'];
    $autor = $_POST['edit_autor'];
    $descricao = $_POST['edit_descricao'];
    $preco = $_POST['edit_preco'];
    $quantidade_estoque = $_POST['edit_quantidade_estoque'];
    $imagem_url = $_POST['edit_imagem_url'];
    $id_categoria = $_POST['edit_id_categoria'];
    $editora = $_POST['edit_editora'];
    $idioma = $_POST['edit_idioma'];
    $encadernacao = $_POST['edit_encadernacao'];
    $numero_paginas = $_POST['edit_numero_paginas'];
    $data_lancamento = $_POST['edit_data_lancamento'];

    try {
        $sql = "UPDATE produtos SET titulo = :titulo, autor = :autor, descricao = :descricao, preco = :preco, quantidade_estoque = :quantidade_estoque, imagem_url = :imagem_url, id_categoria = :id_categoria, editora = :editora, idioma = :idioma, encadernacao = :encadernacao, numero_paginas = :numero_paginas, data_lancamento = :data_lancamento WHERE id_produto = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'descricao' => $descricao,
            'preco' => $preco,
            'quantidade_estoque' => $quantidade_estoque,
            'imagem_url' => $imagem_url,
            'id_categoria' => $id_categoria,
            'editora' => $editora,
            'idioma' => $idioma,
            'encadernacao' => $encadernacao,
            'numero_paginas' => $numero_paginas,
            'data_lancamento' => $data_lancamento,
            'id' => $id
        ]);
        $success_message = "Livro atualizado com sucesso!";
    } catch (PDOException $e) {
        $error_message = "Erro ao atualizar livro: " . $e->getMessage();
    }
}

// Lógica para Excluir Livro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_book'])) {
    $id = $_POST['id_produto'];

    try {
        $sql = "DELETE FROM produtos WHERE id_produto = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $success_message = "Livro excluído com sucesso!";
    } catch (PDOException $e) {
        $error_message = "Erro ao excluir livro: " . $e->getMessage();
    }
}

// Busca todos os livros do banco de dados para exibir na tabela
try {
    $stmt = $conn->query("SELECT p.*, c.nome_categoria FROM produtos p LEFT JOIN categorias c ON p.id_categoria = c.id_categoria ORDER BY p.titulo");
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt_categorias = $conn->query("SELECT * FROM categorias ORDER BY nome_categoria");
    $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erro ao buscar livros ou categorias: " . $e->getMessage();
    $livros = [];
    $categorias = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administrador - Infinity Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <button class="menu-btn" id="toggle-btn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Menu</h2>
        </div>
        <ul>
            <li><a href="#" class="nav-link active" data-section="estoque"><i class="fas fa-boxes"></i>Estoque</a></li>
            <li><a href="#" class="nav-link" data-section="funcionarios"><i class="fas fa-users-cog"></i>Funcionários</a></li>
            <li><a href="inicial.php"><i class="fa-solid fa-store"></i>Ver a Loja </a></li>
            <li><a href="login.php"><i class="fa-solid fa-door-open"></i>Sair</a></li>
        </ul>
    </div>

    <header>
        <div class="logo">
            <img src="images/logo.png" width="150px">
        </div>
        <div class="header-center-content">
            <h1>Painel de Administração</h1>
        </div>
        <div class="header-right-content">
            <a href="#">
                <span>Administrador</span>
                <i class="fa-solid fa-user-shield"></i>
            </a>
        </div>
    </header>

    <main id="conteudo-principal">
        <section id="estoque" class="section active">
            <h2>Gerenciamento de Estoque</h2>

            <?php if (!empty($success_message)) : ?>
                <div class="success-message" style="color: green; margin-bottom: 15px;"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message" style="color: red; margin-bottom: 15px;"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="form-container">
                <h3>Adicionar Novo Livro</h3>
                <form id="form-estoque" method="POST" action="admin.php">
                    <label for="titulo">Título do Livro:</label>
                    <input type="text" id="titulo" name="titulo" required>

                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" required>

                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="3"></textarea>

                    <label for="preco">Preço:</label>
                    <input type="number" id="preco" name="preco" required min="0" step="0.01">

                    <label for="quantidade_estoque">Quantidade:</label>
                    <input type="number" id="quantidade_estoque" name="quantidade_estoque" required min="0">

                    <label for="imagem_url">URL da Imagem:</label>
                    <input type="text" id="imagem_url" name="imagem_url">

                    <label for="id_categoria">Categoria:</label>
                    <select id="id_categoria" name="id_categoria">
                        <option value="">Selecione...</option>
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>">
                                <?php echo htmlspecialchars($categoria['nome_categoria']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="editora">Editora:</label>
                    <input type="text" id="editora" name="editora">

                    <label for="idioma">Idioma:</label>
                    <input type="text" id="idioma" name="idioma">

                    <label for="encadernacao">Encadernação:</label>
                    <input type="text" id="encadernacao" name="encadernacao">

                    <label for="numero_paginas">Nº de Páginas:</label>
                    <input type="number" id="numero_paginas" name="numero_paginas" min="0">

                    <label for="data_lancamento">Data de Lançamento:</label>
                    <input type="date" id="data_lancamento" name="data_lancamento">

                    <button type="submit" name="add_book">Adicionar Item</button>
                </form>
            </div>
            <div class="table-container">
                <h3>Livros em Estoque</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Qtd.</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-estoque">
                        <?php foreach ($livros as $livro) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                                <td><?php echo htmlspecialchars($livro['quantidade_estoque']); ?></td>
                                <td>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></td>
                                <td class="actions">
                                    <button class="btn-edit" onclick='abrirModalEdicao(<?php echo json_encode($livro, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>)'>Editar</button>
                                    <form method="POST" action="admin.php" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                        <input type="hidden" name="id_produto" value="<?php echo $livro['id_produto']; ?>">
                                        <button type="submit" name="delete_book" class="btn-delete">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <div id="modal-edicao" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="fecharModalEdicao()">&times;</span>
            <h2>Editar Livro</h2>
            <form id="form-edicao" method="POST" action="admin.php">
                <input type="hidden" id="edit-id-produto" name="id_produto">
                <label for="edit-titulo">Título do Livro:</label>
                <input type="text" id="edit-titulo" name="edit_titulo" required>

                <label for="edit-autor">Autor:</label>
                <input type="text" id="edit-autor" name="edit_autor" required>

                <label for="edit-descricao">Descrição:</label>
                <textarea id="edit-descricao" name="edit_descricao" rows="3"></textarea>

                <label for="edit-preco">Preço:</label>
                <input type="number" id="edit-preco" name="edit_preco" required min="0" step="0.01">

                <label for="edit-quantidade_estoque">Quantidade:</label>
                <input type="number" id="edit-quantidade_estoque" name="edit_quantidade_estoque" required min="0">

                <label for="edit-imagem_url">URL da Imagem:</label>
                <input type="text" id="edit-imagem_url" name="edit_imagem_url">

                <label for="edit-id_categoria">Categoria:</label>
                <select id="edit-id_categoria" name="edit_id_categoria">
                    <option value="">Selecione...</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>">
                            <?php echo htmlspecialchars($categoria['nome_categoria']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-editora">Editora:</label>
                <input type="text" id="edit-editora" name="edit_editora">

                <label for="edit-idioma">Idioma:</label>
                <input type="text" id="edit-idioma" name="edit_idioma">

                <label for="edit-encadernacao">Encadernação:</label>
                <input type="text" id="edit-encadernacao" name="edit_encadernacao">

                <label for="edit-numero_paginas">Nº de Páginas:</label>
                <input type="number" id="edit-numero_paginas" name="edit_numero_paginas" min="0">

                <label for="edit-data_lancamento">Data de Lançamento:</label>
                <input type="date" id="edit-data_lancamento" name="edit_data_lancamento">

                <button type="submit" name="edit_book">Salvar Alterações</button>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle-btn');
            const sidebar = document.getElementById('sidebar');

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        });

        // Funções para o Modal de Edição de Livros
        function abrirModalEdicao(livro) {
            document.getElementById('edit-id-produto').value = livro.id_produto;
            document.getElementById('edit-titulo').value = livro.titulo;
            document.getElementById('edit-autor').value = livro.autor;
            document.getElementById('edit-descricao').value = livro.descricao;
            document.getElementById('edit-preco').value = livro.preco;
            document.getElementById('edit-quantidade_estoque').value = livro.quantidade_estoque;
            document.getElementById('edit-imagem_url').value = livro.imagem_url;
            document.getElementById('edit-id_categoria').value = livro.id_categoria;
            document.getElementById('edit-editora').value = livro.editora;
            document.getElementById('edit-idioma').value = livro.idioma;
            document.getElementById('edit-encadernacao').value = livro.encadernacao;
            document.getElementById('edit-numero_paginas').value = livro.numero_paginas;
            document.getElementById('edit-data_lancamento').value = livro.data_lancamento;
            document.getElementById('modal-edicao').style.display = 'block';
        }

        function fecharModalEdicao() {
            document.getElementById('modal-edicao').style.display = 'none';
        }
    </script>
</body>

</html>