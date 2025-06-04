<?php
session_start();

// Lista de utilizadores
$utilizadores = [
    'admin' => ['password' => 'admin', 'tipo' => 'admin'],
    'funcionario' => ['password' => 'func1', 'tipo' => 'funcionario'],
    'cliente' => ['password' => 'cliente', 'tipo' => 'cliente']
];

// Dados do formulário
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

// Verifica se utilizador existe e password está correta
if (isset($utilizadores[$user]) && $utilizadores[$user]['password'] === $pass) {
    $_SESSION['user'] = $user;
    $tipo = $utilizadores[$user]['tipo'];

    // Redirecionamento consoante o tipo
    switch ($tipo) {
        case 'admin':
            header('Location: ../admin.html');
            break;
        case 'funcionario':
            header('Location: ../funcionario.html');
            break;
        case 'cliente':
            header('Location: ../cliente.html');
            break;
        default:
            echo "❌ Tipo de utilizador desconhecido.";
            exit;
    }
    exit;
} else {
    echo "❌ Login inválido.<br>";
    echo '<a href="../index.html">Tentar novamente</a>';
}
?>
