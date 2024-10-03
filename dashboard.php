<?php
session_start(); // Inicia a sessão para acessar variáveis de sessão, como o ID do usuário

// Verifica se o usuário está logado, caso não, redireciona para a página de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit; // Encerra o script após o redirecionamento
}

// Incluir a conexão com o banco de dados
include 'conexao.php'; // Conexão com o banco de dados

// Consulta para pegar todos os clientes cadastrados
$resultado_clientes = $mysqli->query("SELECT * FROM clientes"); // Executa a consulta para buscar os dados dos clientes
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Menu de Navegação -->
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
        <h1 class="text-center">Painel de Controle</h1>
        <div class="text-end mb-3">
            <a href="logout.php" class="btn btn-danger">Sair</a> <!-- Botão de Logout -->
        </div>

        <h2>Clientes Cadastrados</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Empresa</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se há clientes cadastrados e os exibe na tabela
                if ($resultado_clientes->num_rows > 0) {
                    while ($cliente = $resultado_clientes->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $cliente['id'] . "</td>"; // Exibe o ID do cliente
                        echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>"; // Exibe o nome
                        echo "<td>" . htmlspecialchars($cliente['sobrenome']) . "</td>"; // Exibe o sobrenome
                        echo "<td>" . htmlspecialchars($cliente['empresa']) . "</td>"; // Exibe a empresa
                        echo "<td>" . htmlspecialchars($cliente['cargo']) . "</td>"; // Exibe o cargo
                        echo "<td>" . htmlspecialchars($cliente['email']) . "</td>"; // Exibe o email
                        echo "<td><a href='editar_cliente.php?id=" . $cliente['id'] . "' class='btn btn-warning'>Editar</a> </td>"; // Link para editar cliente
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum cliente cadastrado.</td></tr>"; // Mensagem caso não haja clientes
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados após o uso
$mysqli->close(); // Fecha a conexão com o banco de dados
?>
