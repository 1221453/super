<?php
session_start();

// Conexão com a base de dados SQLite
$db = new SQLite3(__DIR__ . '/../db/super.db');

// Dados do formulário
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Verificação de campos
if (!$username || !$password) {
    echo "⚠️ Preencha todos os campos.";
    exit;
}

// Procurar utilizador na base de dados
$stmt = $db->prepare("SELECT * FROM utilizadores WHERE username = :username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

// Verificar se existe e se a password corresponde
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['tipo'] = $user['tipo'];

    // Redirecionamento consoante o tipo
    switch ($user['tipo']) {
        case 'admin':
            header('Location: ../admin.html');
            break;
        case 'funcionario':
            header('Location: ../funcionario.html');
            break;
        case 'cliente':
        default:
            header('Location: ../cliente.html');
            break;
    }
    exit;
} else {
    echo "❌ Login inválido.<br>";
    echo '<a href="../index.html">Tentar novamente</a>';
}
?>
