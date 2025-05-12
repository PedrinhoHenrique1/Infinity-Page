const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const bodyParser = require('body-parser');
const axios = require('axios');

const app = express();
const port = 3000;

app.use(cors());
app.use(bodyParser.json());

// Conexão com o MySQL
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'aluno',
    database: 'livraria'
});

db.connect(err => {
    if (err) {
        console.error('Erro ao conectar ao MySQL:', err);
    } else {
        console.log('Conectado ao MySQL!');
    }
});

// Buscar livros na API do Google Books
app.get('/api/buscar', async (req, res) => {
    const { q } = req.query;
    try {
        const response = await axios.get('https://www.googleapis.com/books/v1/volumes', {
            params: { q }
        });
        res.json(response.data.items);
    } catch (error) {
        res.status(500).json({ error: 'Erro ao buscar livros' });
    }
});

// Salvar livro no banco de dados
app.post('/api/livros', (req, res) => {
    const { titulo, autor, descricao, imagem } = req.body;

    const sql = "INSERT INTO livros (titulo, autor, descricao, imagem) VALUES (?, ?, ?, ?)";
    db.query(sql, [titulo, autor, descricao, imagem], (err, result) => {
        if (err) {
            res.status(500).json({ error: 'Erro ao salvar no banco' });
        } else {
            res.json({ message: 'Livro salvo com sucesso!' });
        }
    });
});

// Listar livros salvos
app.get('/api/livros', (req, res) => {
    db.query('SELECT * FROM livros', (err, results) => {
        if (err) {
            res.status(500).json({ error: 'Erro ao buscar livros' });
        } else {
            res.json(results);
        }
    });
});

app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});
