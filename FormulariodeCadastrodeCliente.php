<?php
session_start(); // Iniciar a sessão

// Exibe uma mensagem de sucesso ou erro, dependendo do parâmetro 'status' na URL
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo '<div class="alert alert-success" role="alert">Cliente cadastrado com sucesso!</div>';
    } elseif ($_GET['status'] === 'error') {
        echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar cliente. Tente novamente.</div>';
    }
}

function gerarTokenCSRF() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Gera um token aleatório
    }
    return $_SESSION['csrf_token'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Inclui o menu de navegação -->
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
                        <a class="nav-link active" href="FormulariodeCadastrodeCliente.php">Cadastrar Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center">Cadastro de Cliente</h2>
                <form method="POST" action="salvar_cliente.php">
                    <input type="hidden" name="csrf_token" value="<?php echo gerarTokenCSRF(); ?>">
                    
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
                        <input type="text" class="form-control" id="empresa" name="empresa">
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required 
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                        title="Insira um e-mail válido.">
                    </div>
                    
                    <!-- Seção para adicionar Telefones Dinâmicos -->
                    <div id="telefones" class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control mb-2" name="telefones[]">
                        <button type="button" class="btn btn-danger btn-sm remove-telefone" style="display: none;">Remover</button>
                    </div>
                    <button type="button" class="btn btn-outline-secondary w-100 mb-3" id="adicionar-telefone">Adicionar Telefone</button>

                    <!-- Seção para adicionar Endereços Dinâmicos -->
                    <div id="enderecos" class="mb-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control mb-2" name="enderecos[]">
                        <button type="button" class="btn btn-danger btn-sm remove-endereco" style="display: none;">Remover</button>
                    </div>
                    <button type="button" class="btn btn-outline-secondary w-100 mb-3" id="adicionar-endereco">Adicionar Endereço</button>

                    <div class="mb-3">
                        <label for="observacao" class="form-label">Observações</label>
                        <textarea class="form-control" id="observacao" name="observacao"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Salvar Cliente</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para adicionar novo campo de telefone
        document.getElementById('adicionar-telefone').addEventListener('click', () => {
            const telefoneDiv = document.getElementById('telefones');
            const novoTelefone = document.createElement('input');
            novoTelefone.type = 'text';
            novoTelefone.name = 'telefones[]';
            novoTelefone.classList.add('form-control', 'mb-2');
            telefoneDiv.appendChild(novoTelefone);

            // Adiciona botão remover
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-danger btn-sm remove-telefone';
            removeBtn.innerText = 'Remover';
            telefoneDiv.appendChild(removeBtn);

            // Exibir botão de remover
            removeBtn.style.display = 'inline-block';

            // Evento para remover o campo
            removeBtn.addEventListener('click', () => {
                telefoneDiv.removeChild(novoTelefone);
                telefoneDiv.removeChild(removeBtn);
            });
        });

        // Função para adicionar novo campo de endereço
        document.getElementById('adicionar-endereco').addEventListener('click', () => {
            const enderecoDiv = document.getElementById('enderecos');
            const novoEndereco = document.createElement('input');
            novoEndereco.type = 'text';
            novoEndereco.name = 'enderecos[]';
            novoEndereco.classList.add('form-control', 'mb-2');
            enderecoDiv.appendChild(novoEndereco);

            // Adiciona botão remover
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-danger btn-sm remove-endereco';
            removeBtn.innerText = 'Remover';
            enderecoDiv.appendChild(removeBtn);

            // Exibir botão de remover
            removeBtn.style.display = 'inline-block';

            // Evento para remover o campo
            removeBtn.addEventListener('click', () => {
                enderecoDiv.removeChild(novoEndereco);
                enderecoDiv.removeChild(removeBtn);
            });
        });
    </script>
</body>
</html>
