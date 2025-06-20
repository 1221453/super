<?php
$db = new SQLite3('../dados.db');

$db->exec("CREATE TABLE IF NOT EXISTS produtos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    preco REAL NOT NULL,
    marca TEXT NOT NULL,
    imagem TEXT NOT NULL, 
    descricao TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS tarefas (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  descricao TEXT NOT NULL,
  atribuida BOOLEAN DEFAULT 0,
  atribuida_por TEXT,
  atribuida_a TEXT,
  concluida BOOLEAN DEFAULT 0
)");



$db->exec("CREATE TABLE mensagens (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  remetente TEXT NOT NULL,
  destinatario TEXT NOT NULL,
  origem TEXT NOT NULL,
  conteudo TEXT NOT NULL,
  data DATETIME DEFAULT CURRENT_TIMESTAMP
)");
echo "Base de dados criada com sucesso!";
?>