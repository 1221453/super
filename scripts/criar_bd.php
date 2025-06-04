<?php
// Ativar erros para debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Caminho da base de dados
$dbPath = __DIR__ . '/../db/super.db';

// Verifica se a pasta "db" existe
if (!is_dir(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

// Cria ou abre a base de dados
$db = new SQLite3($dbPath);

// Cria a tabela utilizadores
$db->exec("
    CREATE TABLE IF NOT EXISTS utilizadores (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        tipo TEXT NOT NULL
    )
");

// Inserir utilizadores de exemplo
$utilizadores = [
    ['admin', 'admin', 'admin@empresa.pt', 'admin'],
    ['joana', '123456', 'joana@empresa.pt', 'funcionario'],
    ['carlos', 'cliente', 'carlos@empresa.pt', 'cliente'],
];

foreach ($utilizadores as $u) {
    $stmt = $db->prepare("INSERT OR IGNORE INTO utilizadores (username, password, email, tipo) VALUES (:username, :password, :email, :tipo)");
    $stmt->bindValue(':username', $u[0], SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash($u[1], PASSWORD_DEFAULT), SQLITE3_TEXT);
    $stmt->bindValue(':email', $u[2], SQLITE3_TEXT);
    $stmt->bindValue(':tipo', $u[3], SQLITE3_TEXT);
    $stmt->execute();
}

echo "✅ Base de dados criada com sucesso em: db/super.db";
?>
