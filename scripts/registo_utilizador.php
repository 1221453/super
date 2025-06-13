<?php
session_start();

$db = new SQLite3(__DIR__ . '/../db/super.db');

$db->exec('CREATE TABLE IF NOT EXISTS utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    username TEXT UNIQUE,
    email TEXT,
    password TEXT,
    tipo TEXT
)');

// Criação do admin se não existir
$existeAdmin = $db->querySingle("SELECT COUNT(*) FROM utilizadores WHERE username = 'admin'");
if ($existeAdmin == 0) {
    $stmt = $db->prepare("INSERT INTO utilizadores (nome, username, email, password, tipo)
                          VALUES (:nome, :username, :email, :password, :tipo)");
    $stmt->bindValue(':nome', 'Administrador', SQLITE3_TEXT);
    $stmt->bindValue(':username', 'admin', SQLITE3_TEXT);
    $stmt->bindValue(':email', 'admin@super.pt', SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash('admin', PASSWORD_DEFAULT), SQLITE3_TEXT);
    $stmt->bindValue(':tipo', 'admin', SQLITE3_TEXT);
    $stmt->execute();
}

// Criação do funcionário se não existir
$existeFuncionario = $db->querySingle("SELECT COUNT(*) FROM utilizadores WHERE username = 'funcionario'");
if ($existeFuncionario == 0) {
    $stmt = $db->prepare("INSERT INTO utilizadores (nome, username, email, password, tipo)
                          VALUES (:nome, :username, :email, :password, :tipo)");
    $stmt->bindValue(':nome', 'Funcionário', SQLITE3_TEXT);
    $stmt->bindValue(':username', 'funcionario', SQLITE3_TEXT);
    $stmt->bindValue(':email', 'func01@super.pt', SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash('func01', PASSWORD_DEFAULT), SQLITE3_TEXT);
    $stmt->bindValue(':tipo', 'funcionario', SQLITE3_TEXT);
    $stmt->execute();
}

// Processamento do formulário de registo de utilizador

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm'] ?? '');
    $tipo = $_POST['tipo'] ?? 'cliente';

    if ($nome && $username && $email && $password && $confirm) {
        if ($password !== $confirm) {
            echo "As palavras-passe não coincidem.";
            exit;
        }

        $stmt = $db->prepare("INSERT INTO utilizadores (nome, username, email, password, tipo)
                              VALUES (:nome, :username, :email, :password, :tipo)");
        $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
        $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);

        if ($stmt->execute()) {
            if ($tipo === 'funcionario') {
                header("Location: ../funcionario.html");
            } else {
                header("Location: ../cliente.html");
            }
            exit;
        } else {
            echo "Erro ao registar utilizador.";
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>
