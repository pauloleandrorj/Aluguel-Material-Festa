<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexao.php'; // Conecta ao banco de dados onde estão armazenados os clientes

// Iniciar a sessão para acessar dados do usuário logado
session_start(); // Inicia a sessão para que possamos acessar as variáveis de sessão

// Verifica se o ID do cliente foi passado via URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id']; // Obtém o ID do cliente a ser editado a partir da URL
} else {
    // Se o ID não for encontrado, redireciona para a página de dashboard
    header("Location: dashboard.php"); 
    exit;
}

// Busca as informações do cliente com base no ID
$cliente = $mysqli->prepare("SELECT * FROM clientes WHERE id = ?");
$cliente->bind_param("i", $id_cliente); // 'i' indica que o parâmetro é um inteiro
$cliente->execute(); // Executa a consulta
$resultado_cliente = $cliente->get_result(); // Obtém o resultado da consulta

// Verifica se o cliente foi encontrado
if ($resultado_cliente->num_rows > 0) {
    // Se encontrado, armazena os dados do cliente em variáveis
    $cliente = $resultado_cliente->fetch_assoc();
} else {
    // Se não encontrar o cliente, redireciona para o dashboard
    echo "Cliente não encontrado!";
    exit;
}

// Verifica se os dados do formulário foram enviados via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário e os armazena em variáveis
    $nome = $_POST['nome']; // Nome do cliente
    $sobrenome = $_POST['sobrenome']; // Sobrenome do cliente
    $empresa = $_POST['empresa']; // Empresa do cliente
    $cargo = $_POST['cargo']; // Cargo do cliente
    $email = $_POST['email']; // E-mail do cliente
    $observacao = $_POST['observacao']; // Observação sobre o cliente

    // Atualiza os dados do cliente no banco de dados
    $atualizar_cliente = $mysqli->prepare("UPDATE clientes SET nome = ?, sobrenome = ?, empresa = ?, cargo = ?, email = ?, observacao = ? WHERE id = ?");
    $atualizar_cliente->bind_param("ssssssi", $nome, $sobrenome, $empresa, $cargo, $email, $observacao, $id_cliente); // 'ssssssi' indica que os parâmetros são strings e um inteiro
    if ($atualizar_cliente->execute()) {
        // Se a atualização for bem-sucedida, exibe uma mensagem de sucesso
        echo "Cliente atualizado com sucesso! <a href='dashboard.php'>Voltar para o painel</a>";
    } else {
        // Se ocorrer algum erro, exibe uma mensagem de erro
        echo "Erro ao atualizar o cliente: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Menu de navegação (mesmo utilizado em outras páginas) -->
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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Editar Cliente</h1>

        <!-- Formulário para editar os dados do cliente -->
        <form action="editar_cliente.php?id=<?php echo $id_cliente; ?>" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo htmlspecialchars($cliente['sobrenome']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo htmlspecialchars($cliente['empresa']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo htmlspecialchars($cliente['cargo']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="observacao" class="form-label">Observações</label>
                <textarea class="form-control" id="observacao" name="observacao" rows="3"><?php echo htmlspecialchars($cliente['observacao']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
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
