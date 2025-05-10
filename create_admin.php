<?php
// Conectar ao banco de dados
require_once 'config/database.php'; // Verifique se o caminho está correto

// Definir nome de usuário e senha
$username = 'admin';
$password = 'admin';

// Gerar o hash da senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserir o administrador no banco de dados
try {
    // Inserir o administrador na tabela "admins"
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
    echo "Administrador inserido com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao inserir administrador: " . $e->getMessage();
}
?>
