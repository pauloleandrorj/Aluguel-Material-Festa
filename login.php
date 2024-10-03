<?php
// Habilitar exibição de erros (útil para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar a sessão para gerenciar autenticação
session_start();

// Incluir a conexão com o banco de dados
include 'conexao.php'; 

// Verifica se a requisição foi feita pelo método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitiza o email
    $senha = $_POST['senha']; // Senha não é sanitizada por questões de segurança, já que será verificada

    // Preparar consulta para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email); // Associa o parâmetro
    $stmt->execute(); // Executa a consulta
    $stmt->store_result(); // Armazena o resultado para verificar se o usuário existe

    // Verifica se o usuário existe
    if ($stmt->num_rows > 0) {
        // Usuário encontrado, recupera os dados
        $stmt->bind_result($id, $hashed_password); // Associa as variáveis
        $stmt->fetch(); // Obtém os dados

        // Verifica se a senha está correta usando password_verify
        if (password_verify($senha, $hashed_password)) {
            // Senha correta, iniciar sessão
            $_SESSION['usuario_id'] = $id; // Armazena o ID do usuário na sessão
            header("Location: dashboard.php"); // Redireciona para o painel de controle
            exit; // Interrompe a execução após redirecionamento
        } else {
            // Senha incorreta, exibe mensagem de erro
            echo '<div class="alert alert-danger" role="alert">Senha incorreta. Tente novamente.</div>';
        }
    } else {
        // Usuário não encontrado, exibe mensagem de erro
        echo '<div class="alert alert-danger" role="alert">Usuário não encontrado.</div>';
    }

    // Fechar a consulta
    $stmt->close();
    // Fechar a conexão com o banco de dados
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <h2 class="text-center">Login</h2>
                <form method="POST" action="login.php">
                    <!-- Campo para o E-mail -->
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- Campo para a Senha -->
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <!-- Botão de Login -->
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
