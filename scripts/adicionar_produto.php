<?php
$db = new SQLite3('../dados.db');

$nome = $_POST['nome_produto'];
$preco = $_POST['preco'];
$marca = $_POST['marca'];
$descricao = $_POST['descricao'];

$stmt = $db->prepare("INSERT INTO produtos (nome, preco, marca, descricao) VALUES (?, ?, ?, ?)");
$stmt->bindValue(1, $nome);
$stmt->bindValue(2, $preco);
$stmt->bindValue(3, $marca);
$stmt->bindValue(4, $descricao);
$stmt->execute();

echo "Produto '$nome' adicionado com sucesso!";
?>