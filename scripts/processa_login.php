<?php
session_start();

$db = new SQLite3(__DIR__ . '/../db/super.db');

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$username || !$password) {
    echo "⚠️ Preencha todos os campos.";
    exit;
}

$stmt = $db->prepare("SELECT * FROM utilizadores WHERE username = :username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['tipo'] = $user['tipo'];
    echo "OK:" . $user['tipo']; // Só devolve texto tratado via JS
} else {
    echo "❌ Login inválido. Verifique os dados.";
}
