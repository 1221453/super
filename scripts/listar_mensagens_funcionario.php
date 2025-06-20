<?php
header('Content-Type: application/json');

$db = new SQLite3('../dados.db');

$result = $db->query("SELECT * FROM mensagens WHERE remetente = 'funcionario' AND destinatario = 'admin' ORDER BY data DESC");

$mensagens = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $mensagens[] = $row;
}

echo json_encode($mensagens);
?>
