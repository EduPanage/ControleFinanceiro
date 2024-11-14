<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Controle Financeiro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="header-banner">
        <h1>Controle Financeiro</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Cadastro de Usuário</span>
                        <form id="formCadastro">
                            <div class="input-field">
                                <input type="text" name="nome" id="nome" required>
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field">
                                <input type="email" name="email" id="email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="senha" id="senha" required minlength="6">
                                <label for="senha">Senha (mínimo 6 caracteres)</label>
                            </div>
                            <button type="submit" class="btn teal">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer teal lighten-2">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Controle Financeiro</h5>
                    <p class="grey-text text-lighten-4">Gerencie suas finanças pessoais de forma fácil e eficiente sem sair do conforto da sua casa. Acesse de onde quiser!</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="white-text" href="cadastro.php">Home</a></li>
                        <li><a class="white-text" href="registrar_transacao.php">Transações</a></li>
                        <li><a class="white-text" href="sobre.php">Sobre</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2024 Controle Financeiro, Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <a href="pagina_transacoes.php" class="btn-floating btn-large waves-effect waves-light teal">
        <i class="material-icons">add</i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        document.getElementById('formCadastro').addEventListener('submit', function (e) {
            e.preventDefault();

            var nome = document.getElementById('nome').value;
            var email = document.getElementById('email').value;
            var senha = document.getElementById('senha').value;

            var data = {
                nome: nome,
                email: email,
                senha: senha
            };

            fetch('http://localhost/api/apiUser.php', {     //validar sobre a questão do BD
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message === "Usuário criado com sucesso.") {
                    localStorage.setItem('nomeUsuario', nome);
                    window.location.href = "registrar_transacao.php"; 
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
