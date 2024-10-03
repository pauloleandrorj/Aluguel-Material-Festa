<?php
// Iniciar a sessão para acessar dados do usuário
session_start();

// Incluir a conexão com o banco de dados
include 'conexao.php'; // Arquivo de conexão com o banco de dados

// Verificar se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Pegando os dados do formulário e protegendo contra injeção de SQL
    $nome = $mysqli->real_escape_string($_POST['nome']); // Protege o nome
    $sobrenome = $mysqli->real_escape_string($_POST['sobrenome']); // Protege o sobrenome
    $email = $mysqli->real_escape_string($_POST['email']); // Protege o email
    $senha = $_POST['senha']; // Senha sem escape, pois vamos criptografar
    $confirmar_senha = $_POST['confirmar_senha']; // Confirmação de senha

    // Verificar se as senhas são iguais
    if ($senha !== $confirmar_senha) {
        // Senhas não coincidem, redireciona de volta para o formulário com erro
        $_SESSION['erro'] = "As senhas não coincidem!";
        header("Location: FormulariodeRegistro.php");
        exit;
    }

    // Criptografar a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a senha

    // Verificar se o email já está cadastrado
    $verifica_email = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");
    if ($verifica_email->num_rows > 0) {
        // Se o email já existir, redireciona com erro
        $_SESSION['erro'] = "Este email já está cadastrado!";
        header("Location: FormulariodeRegistro.php");
        exit;
    }

    // Inserir os dados do usuário no banco de dados
    $query = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES ('$nome', '$sobrenome', '$email', '$senha_criptografada')";
    if ($mysqli->query($query)) {
        // Usuário registrado com sucesso, redireciona para o login
        $_SESSION['sucesso'] = "Usuário registrado com sucesso!";
        header("Location: login.php");
        exit;
    } else {
        // Caso haja erro ao inserir no banco
        $_SESSION['erro'] = "Erro ao registrar usuário!";
        header("Location: FormulariodeRegistro.php");
        exit;
    }
} else {
    // Se o formulário não foi enviado via POST, redireciona para a página de registro
    header("Location: FormulariodeRegistro.php");
    exit;
}
