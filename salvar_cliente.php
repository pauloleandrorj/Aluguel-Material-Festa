<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexao.php'; // Conecta ao banco de dados onde os clientes são armazenados

// Iniciar a sessão para acessar dados do usuário logado
session_start(); // Inicia a sessão para que possamos acessar as variáveis de sessão

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário e os armazena em variáveis
    $nome = $_POST['nome']; // Nome do cliente
    $sobrenome = $_POST['sobrenome']; // Sobrenome do cliente
    $empresa = $_POST['empresa']; // Empresa do cliente
    $cargo = $_POST['cargo']; // Cargo do cliente
    $email = $_POST['email']; // E-mail do cliente
    $observacao = $_POST['observacao']; // Observação sobre o cliente

    // Prepara e executa a inserção dos dados no banco de dados
    $inserir_cliente = $mysqli->prepare("INSERT INTO clientes (nome, sobrenome, empresa, cargo, email, observacao) VALUES (?, ?, ?, ?, ?, ?)");
    $inserir_cliente->bind_param("ssssss", $nome, $sobrenome, $empresa, $cargo, $email, $observacao); // 'ssssss' indica que todos os parâmetros são strings
    if ($inserir_cliente->execute()) {
        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
        echo "Cliente cadastrado com sucesso! <a href='dashboard.php'>Voltar para o painel</a>";
    } else {
        // Se ocorrer algum erro, exibe uma mensagem de erro
        echo "Erro ao cadastrar o cliente: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Menu de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="FormulariodeCadastrodeCliente.php">Cadastrar Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Cadastrar Novo Cliente</h1>

        <!-- Formulário para cadastrar um novo cliente -->
        <form action="salvar_cliente.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            </div>

            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" required>
            </div>

            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="observacao" class="form-label">Observações</label>
                <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
        </form>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$mysqli->close(); // Fecha a conexão com o banco de dados após o fim do processo
?>
