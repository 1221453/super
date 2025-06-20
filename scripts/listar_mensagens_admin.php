<?php
header('Content-Type: application/json');
$db = new SQLite3('../dados.db');

// Admin quer ver todas as mensagens trocadas com funcionário
$result = $db->query("
  SELECT * FROM mensagens 
  WHERE (remetente = 'admin' AND destinatario = 'funcionario') 
     OR (remetente = 'funcionario' AND destinatario = 'admin') 
  ORDER BY data DESC
");

$mensagens = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $mensagens[] = $row;
}

echo json_encode($mensagens);
?>
