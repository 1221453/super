<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Caminho relativo a partir da pasta scripts/ para ../db/
$dbPath = realpath(__DIR__ . '/../') . '/db/super.db';

// Verifica e cria a pasta db se não existir
$dbDir = dirname($dbPath);
if (!is_dir($dbDir)) {
    if (!mkdir($dbDir, 0777, true)) {
        die("❌ Erro: não foi possível criar a pasta 'db' em $dbDir");
    }
}

// Cria ou abre a base de dados
try {
    $db = new SQLite3($dbPath);
    echo "✅ Base de dados criada em: $dbPath<br>";
} catch (Exception $e) {
    die("❌ Erro ao criar a base de dados: " . $e->getMessage());
}

// Cria a tabela
$result = $db->exec("
    CREATE TABLE IF NOT EXISTS utilizadores (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        tipo TEXT NOT NULL
    )
");

if (!$result) {
    die("❌ Erro ao criar tabela: " . $db->lastErrorMsg());
}


foreach ($utilizadores as $u) {
    $stmt = $db->prepare("INSERT OR IGNORE INTO utilizadores (username, password, email, tipo) 
                          VALUES (:username, :password, :email, :tipo)");
    $stmt->bindValue(':username', $u[0], SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash($u[1], PASSWORD_DEFAULT), SQLITE3_TEXT);
    $stmt->bindValue(':email', $u[2], SQLITE3_TEXT);
    $stmt->bindValue(':tipo', $u[3], SQLITE3_TEXT);
    $stmt->execute();
}

// Criação de tabela de mensagens
$result = $db->exec("
    CREATE TABLE IF NOT EXISTS mensagens (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        remetente TEXT NOT NULL,
        destinatario TEXT NOT NULL,
        conteudo TEXT NOT NULL,
        data_envio DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

if (!$result) {
    die('❌ Erro ao criar tabela mensagens: ' . $db->lastErrorMsg());
}

echo "✅ Tabela criada e utilizadores inseridos com sucesso.";
?>
