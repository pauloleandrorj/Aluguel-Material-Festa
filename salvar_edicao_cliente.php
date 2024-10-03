<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Incluir a conexão com o banco de dados
include 'conexao.php';

// Verificar se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $id_cliente = $_POST['id']; // ID do cliente
    $nome = $_POST['nome']; // Nome do cliente
    $sobrenome = $_POST['sobrenome']; // Sobrenome do cliente
    $empresa = $_POST['empresa']; // Empresa do cliente
    $cargo = $_POST['cargo']; // Cargo do cliente
    $email = $_POST['email']; // E-mail do cliente

    // Atualizar os dados do cliente no banco de dados
    $query = "UPDATE clientes SET nome = ?, sobrenome = ?, empresa = ?, cargo = ?, email = ? WHERE id = ?";
    
    // Preparar a consulta
    if ($stmt = $mysqli->prepare($query)) {
        // Bind dos parâmetros
        $stmt->bind_param("sssssi", $nome, $sobrenome, $empresa, $cargo, $email, $id_cliente);

        // Executar a consulta
        if ($stmt->execute()) {
            // Se a atualização for bem-sucedida, redireciona para o painel de controle
            header("Location: dashboard.php");
            exit;
        } else {
            // Se ocorrer um erro, exibe uma mensagem
            echo "Erro ao atualizar o cliente: " . $stmt->error;
        }
    } else {
        // Se não conseguir preparar a consulta, exibe um erro
        echo "Erro ao preparar a consulta: " . $mysqli->error;
    }
} else {
    // Se o formulário não for enviado, redireciona para o painel de controle
    header("Location: dashboard.php");
    exit;
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>
