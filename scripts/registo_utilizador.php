
<?php
session_start();

$db = new SQLite3('../db/super.db');

$db->exec('CREATE TABLE IF NOT EXISTS utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    password TEXT
)');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($username && $password && $confirm) {
        if ($password !== $confirm) {
            echo "As palavras-passe não coincidem.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare('INSERT INTO utilizadores (username, password) VALUES (:username, :password)');
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $hashed, SQLITE3_TEXT);

            if ($stmt->execute()) {
                echo "Utilizador registado com sucesso!";
            } else {
                echo "Erro ao registar utilizador (pode já existir).";
            }
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>
