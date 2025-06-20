<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
  echo json_encode(["sucesso" => false, "erro" => "Dados inválidos."]);
  exit;
}

$id = intval($data['id'] ?? 0);
$nome = trim($data['nome'] ?? '');
$email = trim($data['email'] ?? '');
$tipo = trim($data['tipo'] ?? '');

$db = new SQLite3('../db/super.db');
$stmt = $db->prepare("UPDATE utilizadores SET nome = :nome, email = :email, tipo = :tipo WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);

if ($stmt->execute()) {
  echo json_encode(["sucesso" => true]);
} else {
  echo json_encode(["sucesso" => false, "erro" => "Erro na base de dados."]);
}
?>
