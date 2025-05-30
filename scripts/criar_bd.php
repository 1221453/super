<?php
// Caminho da base de dados
$dbPath = __DIR__ . '/../db/super.db';

// Cria (ou abre) a base de dados
$db = new SQLite3($dbPath);

// Criação da tabela 'utilizadores'
$db->exec('
    CREATE TABLE IF NOT EXISTS utilizadores (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        email TEXT
    )
');

// Inserir o admin com password simples (para teste)
// ⚠️ Usa password_hash() para segurança real
$adminUser = 'admin';
$adminPass = password_hash('admin', PASSWORD_DEFAULT); // segura
$adminEmail = 'admin@exemplo.com';

$stmt = $db->prepare('INSERT OR IGNORE INTO utilizadores (username, password, email) VALUES (:u, :p, :e)');
$stmt->bindValue(':u', $adminUser, SQLITE3_TEXT);
$stmt->bindValue(':p', $adminPass, SQLITE3_TEXT);
$stmt->bindValue(':e', $adminEmail, SQLITE3_TEXT);
$stmt->execute();

echo "✅ Base de dados criada em: db/super.db";
?>
