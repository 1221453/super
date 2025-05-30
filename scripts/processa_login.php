<?php
session_start();

$username = 'admin';
$password = 'admin';

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';
// Verifica se o utilizador já está autenticado

// Verifica se os dados foram enviados
if ($user === $username && $pass === $password) {
    // Autenticação bem-sucedida
    $_SESSION['user'] = $user;
    echo "✅ Login bem-sucedido!";
} else {
    echo "❌ Login inválido.";
    echo '<a href="../index.html">Tentar novamente</a>';
}

?>
