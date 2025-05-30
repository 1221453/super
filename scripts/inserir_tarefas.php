<?php
$db = new SQLite3('../dados.db');

$tarefas = [
    'Reposição das prateleiras',
    'Verificar a validade dos iogurtes',
    'Higienização dos carrinhos e cestos',
    'Preparação dos pedidos dos clientes'
];

foreach ($tarefas as $descricao) {
    $stmt = $db->prepare("INSERT INTO tarefas (descricao, concluida) VALUES (?, 0)");
    $stmt->bindValue(1, $descricao);
    $stmt->execute();
}

echo "Tarefas inseridas com sucesso!";
?>
