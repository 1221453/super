<?php
header('Content-Type: application/json');

$db = new SQLite3('../dados.db');

$input = json_decode(file_get_contents('php://input'), true);

$conteudo = trim($input['conteudo'] ?? '');
$remetente = trim($input['remetente'] ?? '');
$destinatario = ($remetente === 'admin') ? 'funcionario' : 'admin';
$origem = ucfirst($remetente);

if (!$conteudo || !$remetente) {
    http_response_code(400);
    echo json_encode(['erro' => 'Faltam dados.']);
    exit;
}

$stmt = $db->prepare("INSERT INTO mensagens (remetente, destinatario, origem, conteudo) VALUES (:remetente, :destinatario, :origem, :conteudo)");
$stmt->bindValue(':remetente', $remetente, SQLITE3_TEXT);
$stmt->bindValue(':destinatario', $destinatario, SQLITE3_TEXT);
$stmt->bindValue(':origem', $origem, SQLITE3_TEXT);
$stmt->bindValue(':conteudo', $conteudo, SQLITE3_TEXT);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao enviar mensagem.']);
}
