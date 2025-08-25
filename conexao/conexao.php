<?php
$host = "localhost";
$db   = "infinity_page";    
$user = "root";             
$pass = "";                

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão bem-sucedida!";
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>

