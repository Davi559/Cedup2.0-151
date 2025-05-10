<?php
$host = 'localhost';
$dbname = 'cedup';
$username = 'root'; // Se estiver utilizando XAMPP, o padrão é 'root' e a senha geralmente é em branco
$password = '';

try {
    // Criação da conexão PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro do PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
