<?php
header('Content-Type: application/json');

$db = new SQLite3('../dados.db');

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['erro' => 'ID inválido.']);
    exit;
}

$stmt = $db->prepare("DELETE FROM mensagens WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['erro' => 'Erro ao apagar.']);
}
