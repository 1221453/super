<?php
$db = new SQLite3('../dados.db');

$resposta = $_POST['resposta'];

$stmt = $db->prepare("INSERT INTO mensagens (origem, conteudo) VALUES ('Funcionario', ?)");
$stmt->bindValue(1, $resposta);
$stmt->execute();

echo "Resposta enviada com sucesso.";
?>