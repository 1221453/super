<?php
// scripts/criar_utilizador.php
session_start();
$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Criar Novo Utilizador</title>
    <link rel="stylesheet" href="styles/base.css">
</head>
<body>
    <div class="container">
        <h2>Criar Novo Utilizador</h2>

        <?php if ($mensagem): ?>
            <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <form action="scripts/criar_utilizador.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="funcao">Função:</label>
            <select id="funcao" name="funcao" required>
                <option value="Estudante">Estudante</option>
                <option value="Funcionário">Funcionário</option>
                <option value="Administrador">Administrador</option>
                <option value="Outro">Outro</option>
            </select>

            <button type="submit" class="btn">CRIAR UTILIZADOR</button>
        </form>

        <br><a href="admin.html">← Voltar para Administração</a>
    </div>
</body>
</html>
