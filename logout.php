<?php
// Inclui a conexão com o banco de dados
include 'conexao.php'; // Conexão com o banco de dados (não é usada diretamente nesta página, mas está aqui por precaução)

// Inicia a sessão para poder manipular as variáveis de sessão
session_start(); // Inicia a sessão para ter acesso às variáveis de sessão, como o ID do usuário logado

// Destrói a sessão, efetivamente deslogando o usuário
session_destroy(); // Esta função apaga todos os dados da sessão, "deslogando" o usuário

// Redireciona o usuário para a página de login após o logout
header("Location: login.php"); // Redireciona para a página de login
exit; // Encerra o script após o redirecionamento para garantir que nada mais seja executado
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Código do Menu de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="FormulariodeCadastrodeCliente.php">Cadastrar Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="FormulariodeRegistro.php">Registrar Usuário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Mensagem de confirmação de logout -->
        <h1>Você foi desconectado com sucesso!</h1>
        <p><a href="login.php">Clique aqui para fazer login novamente.</a></p>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
