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
    $estoque = $_POST['quantidade_estoque'];
    $categoria_id = $_POST['id_categoria'];
    $editora = $_POST['editora'];
    $idioma = $_POST['idioma'];
    $encadernacao = $_POST['encadernacao'];
    $numero_paginas = $_POST['numero_paginas'];
    $data_lancamento = $_POST['data_lancamento'];

    try {
        $sql = "INSERT INTO produtos (titulo, autor, descricao, preco, quantidade_estoque, id_categoria, editora, idioma, encadernacao, numero_paginas, data_lancamento) VALUES (:titulo, :autor, :descricao, :preco, :quantidade_estoque, :id_categoria, :editora, :idioma, :encadernacao, :numero_paginas, :data_lancamento)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'descricao' => $descricao,
            'preco' => $preco,
            'quantidade_estoque' => $estoque,
            'id_categoria' => $categoria_id,
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
    $id_produto = $_POST['id_produto_edit'];
    $titulo = $_POST['titulo_edit'];
    $autor = $_POST['autor_edit'];
    $descricao = $_POST['descricao_edit'];
    $preco = $_POST['preco_edit'];
    $estoque = $_POST['estoque_edit'];
    $categoria_id = $_POST['categoria_edit'];
    $editora = $_POST['editora_edit'];
    $idioma = $_POST['idioma_edit'];
    $encadernacao = $_POST['encadernacao_edit'];
    $numero_paginas = $_POST['paginas_edit'];
    $data_lancamento = $_POST['lancamento_edit'];

    try {
        $sql = "UPDATE produtos SET 
                    titulo = :titulo, 
                    autor = :autor, 
                    descricao = :descricao,
                    preco = :preco, 
                    quantidade_estoque = :estoque,
                    id_categoria = :id_categoria,
                    editora = :editora,
                    idioma = :idioma,
                    encadernacao = :encadernacao,
                    numero_paginas = :numero_paginas,
                    data_lancamento = :data_lancamento
                WHERE id_produto = :id_produto";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'descricao' => $descricao,
            'preco' => $preco,
            'estoque' => $estoque,
            'id_categoria' => $categoria_id,
            'editora' => $editora,
            'idioma' => $idioma,
            'encadernacao' => $encadernacao,
            'numero_paginas' => $numero_paginas,
            'data_lancamento' => $data_lancamento,
            'id_produto' => $id_produto
        ]);
        $success_message = "Livro atualizado com sucesso!";
    } catch (PDOException $e) {
        $error_message = "Erro ao editar livro: " . $e->getMessage();
    }
}


// Lógica para Excluir Livro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_book'])) {
    $id_produto = $_POST['id_produto_delete'];

    try {
        $sql = "DELETE FROM produtos WHERE id_produto = :id_produto";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_produto' => $id_produto]);
        $success_message = "Livro excluído com sucesso!";
    } catch (PDOException $e) {
        $error_message = "Erro ao excluir livro: " . $e->getMessage();
    }
}


// Lógica para Adicionar Funcionário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissao = $_POST['permissao'];

    try {
        $sql = "INSERT INTO funcionarios (nome, email, senha, permissao) VALUES (:nome, :email, :senha, :permissao)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha, 'permissao' => $permissao]);
        $success_message = "Funcionário adicionado com sucesso!";
    } catch (PDOException $e) {
        $error_message = "Erro ao adicionar funcionário: " . $e->getMessage();
    }
}

// Busca todos os livros e funcionários
try {
    $stmt_livros = $conn->query("SELECT p.*, c.nome_categoria FROM produtos p LEFT JOIN categorias c ON p.id_categoria = c.id_categoria ORDER BY p.titulo");
    $livros = $stmt_livros->fetchAll(PDO::FETCH_ASSOC);

    $stmt_categorias = $conn->query("SELECT * FROM categorias ORDER BY nome_categoria");
    $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

    $stmt_funcionarios = $conn->query("SELECT * FROM funcionarios ORDER BY nome");
    $funcionarios = $stmt_funcionarios->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erro ao buscar dados: " . $e->getMessage();
    $livros = [];
    $categorias = [];
    $funcionarios = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administrador - Infinity Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <button class="menu-btn" id="toggle-btn"><i class="fa-solid fa-bars"></i></button>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h2>Gerenciar</h2>
        </div>
        <ul>
            <li><a href="#" class="nav-link active" data-section="estoque"><i class="fas fa-boxes"></i>Estoque</a></li>
            <li><a href="#" class="nav-link" data-section="funcionarios"><i class="fas fa-users-cog"></i>Funcionários</a></li>
            <li><a href="inicial.php"><i class="fa-solid fa-store"></i>Ver a Loja</a></li>
            <li><a href="login.php"><i class="fa-solid fa-door-open"></i>Sair</a></li>
        </ul>
    </div>

    <header>
        <div class="logo"><img src="images/logo.png" width="150px"></div>
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
        <?php if (!empty($success_message)) : ?>
            <div class="success-message" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)) : ?>
            <div class="error-message" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <section id="estoque" class="section active">
            <h2>Gerenciamento de Estoque</h2>
            <div class="form-container">
                <h3>Adicionar Novo Livro</h3>
                <form id="form-estoque" method="POST" action="admin.php">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>
                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" required>
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4"></textarea>
                    <label for="preco">Preço:</label>
                    <input type="number" step="0.01" id="preco" name="preco" required>
                    <label for="quantidade_estoque">Estoque:</label>
                    <input type="number" id="quantidade_estoque" name="quantidade_estoque" required>
                    <label for="id_categoria">Categoria:</label>
                    <select id="id_categoria" name="id_categoria">
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo htmlspecialchars($categoria['nome_categoria']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="editora">Editora:</label>
                    <input type="text" id="editora" name="editora">
                    <label for="idioma">Idioma:</label>
                    <input type="text" id="idioma" name="idioma">
                    <label for="encadernacao">Encadernação:</label>
                    <input type="text" id="encadernacao" name="encadernacao">
                    <label for="numero_paginas">Nº de Páginas:</label>
                    <input type="number" id="numero_paginas" name="numero_paginas">
                    <label for="data_lancamento">Ano de Lançamento:</label>
                    <input type="number" id="data_lancamento" name="data_lancamento">
                    <button type="submit" name="add_book">Adicionar Livro</button>
                </form>
            </div>
            <div class="table-container">
                <h3>Livros em Estoque</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($livros as $livro) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                                <td>R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($livro['quantidade_estoque']); ?></td>
                                <td><?php echo htmlspecialchars($livro['nome_categoria']); ?></td>
                                <td class="actions">
                                    <button class="btn-edit" onclick="abrirModalEdicao(<?php echo htmlspecialchars(json_encode($livro)); ?>)">Editar</button>
                                    <form method="POST" action="admin.php" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                        <input type="hidden" name="id_produto_delete" value="<?php echo $livro['id_produto']; ?>">
                                        <button type="submit" name="delete_book" class="btn-delete">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="funcionarios" class="section">
            <h2>Gerenciamento de Funcionários</h2>
            <div class="form-container">
                <h3>Adicionar Novo Funcionário</h3>
                <form id="form-funcionarios" method="POST" action="admin.php">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <label for="permissao">Permissão:</label>
                    <select id="permissao" name="permissao">
                        <option value="Funcionário">Funcionário</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                    <button type="submit" name="add_employee">Adicionar Funcionário</button>
                </form>
            </div>

            <div class="table-container">
                <h3>Funcionários Cadastrados</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Permissão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funcionarios as $funcionario) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['email']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['permissao']); ?></td>
                                <td class="actions">
                                    <button class="btn-edit">Editar</button>
                                    <button class="btn-delete">Excluir</button>
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
            <h3>Editar Livro</h3>
            <form id="form-edicao" method="POST" action="admin.php">
                <input type="hidden" id="id_produto_edit" name="id_produto_edit">
                <label for="titulo_edit">Título:</label>
                <input type="text" id="titulo_edit" name="titulo_edit" required>
                <label for="autor_edit">Autor:</label>
                <input type="text" id="autor_edit" name="autor_edit" required>
                <label for="descricao_edit">Descrição:</label>
                <textarea id="descricao_edit" name="descricao_edit" rows="4"></textarea>
                <label for="preco_edit">Preço:</label>
                <input type="number" step="0.01" id="preco_edit" name="preco_edit" required>
                <label for="estoque_edit">Estoque:</label>
                <input type="number" id="estoque_edit" name="estoque_edit" required>
                <label for="categoria_edit">Categoria:</label>
                <select id="categoria_edit" name="categoria_edit">
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo htmlspecialchars($categoria['nome_categoria']); ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="editora_edit">Editora:</label>
                <input type="text" id="editora_edit" name="editora_edit">
                <label for="idioma_edit">Idioma:</label>
                <input type="text" id="idioma_edit" name="idioma_edit">
                <label for="encadernacao_edit">Encadernação:</label>
                <input type="text" id="encadernacao_edit" name="encadernacao_edit">
                <label for="paginas_edit">Nº de Páginas:</label>
                <input type="number" id="paginas_edit" name="paginas_edit">
                <label for="lancamento_edit">Ano de Lançamento:</label>
                <input type="number" id="lancamento_edit" name="lancamento_edit">
                <button type="submit" name="edit_book">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>