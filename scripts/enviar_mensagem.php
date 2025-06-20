<?php
session_start();
$db = new SQLite3('../dados.db');

$resposta = trim($_POST['resposta'] ?? '');
if (!$resposta) {
    die("Mensagem vazia.");
}

$remetente = $_SESSION['user'] ?? 'funcionario';
$destinatario = ($remetente === 'admin') ? 'funcionario' : 'admin';
$origem = ucfirst($remetente); // "Admin" ou "Funcionario"

$stmt = $db->prepare("INSERT INTO mensagens (remetente, destinatario, origem, conteudo) VALUES (:remetente, :destinatario, :origem, :conteudo)");
$stmt->bindValue(':remetente', $remetente, SQLITE3_TEXT);
$stmt->bindValue(':destinatario', $destinatario, SQLITE3_TEXT);
$stmt->bindValue(':origem', $origem, SQLITE3_TEXT);
$stmt->bindValue(':conteudo', $resposta, SQLITE3_TEXT);

if ($stmt->execute()) {
    echo "Mensagem enviada com sucesso.";
} else {
    echo "Erro ao enviar mensagem.";
}
?>
