<?php
session_start();

if (!isset($_SESSION['nome_usuario'])) {
    header('Location: cadastro.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transações - Controle Financeiro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="header-banner">
        <h1>Controle de Transações</h1>
    </div>

    <div class="container">
        <h4>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</h4>
        
        <form action="registrar_transacao.php" method="POST">
            <div class="input-field">
                <input type="number" name="valor" id="valor" required>
                <label for="valor">Valor</label>
            </div>
            <div class="input-field">
                <select name="tipo_transacao" id="tipo_transacao" required>
                    <option value="entrada" selected>Entrada</option>
                    <option value="saida">Saída</option>
                </select>
                <label for="tipo_transacao">Tipo de Transação</label>
            </div>
            <button type="submit" class="btn teal">Registrar Transação</button>
        </form>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
</body>
</html>
