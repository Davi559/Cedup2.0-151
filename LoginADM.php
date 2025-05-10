<?php
session_start();
require_once 'config/database.php'; // Certifique-se de que o caminho está correto

// Variáveis de erro
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter as informações do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Verificar se o usuário existe no banco de dados
    try {
        // Consultar o banco de dados para encontrar o usuário
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar se o usuário foi encontrado e a senha é válida
        if ($user) {           

            if (password_verify($password, $user['password'])) {
                // Login válido – salva dados na sessão
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = true; // Define que este usuário é admin

                // Redireciona para a área administrativa
                header('Location: ./index_ADM.php');
                exit;
            } else {
                $error = 'Senha incorreta.';
            }
        } else {
            $error = 'Usuário não encontrado.';
        }
    } catch (PDOException $e) {
        $error = 'Erro de conexão: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cedup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <img src="assets/img/cedup-logo.png" alt="Cedup Logo" style="height: 80px; width: auto; opacity: 1; filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.4));">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
