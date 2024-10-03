<?php
// Informações de conexão
$host = 'localhost';
$db = 'BD_PP';
$user = 'root';
$password = '';

// Criando a conexão
$mysqli = new mysqli($host, $user, $password, $db);

// Verificando se a conexão foi estabelecida
if ($mysqli->connect_error) {
    die("Conexão falhou: " . $mysqli->connect_error);
}

// Comente ou remova esta linha para evitar a mensagem
// echo "Conexão realizada com sucesso!";


// CSRF Token
// Vamos implementar a proteção contra CSRF. Criaremos uma função para gerar um token exclusivo 
// para cada sessão de usuário e adicionaremos esse token em cada formulário.
// Função para gerar o token CSRF
// Função para gerar um token CSRF
function gerarTokenCSRF() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Gera um token aleatório
    }
    return $_SESSION['csrf_token']; // Retorna o token
}

// Função para validar o token CSRF
function validarTokenCSRF($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token); // Compara o token enviado com o gerado
}
?>




