<?php
header('Content-Type: application/json');

$db = new SQLite3(__DIR__ . '/../db/super.db');

$result = $db->query('SELECT id, nome, username, email, tipo FROM utilizadores');

$utilizadores = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $utilizadores[] = $row;
}

echo json_encode($utilizadores);
?>
