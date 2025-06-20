<?php
$db = new SQLite3('../dados.db');

$db->exec("UPDATE tarefas SET concluida = 0");

if (isset($_POST['tarefas'])) {
    foreach ($_POST['tarefas'] as $tarefa) {
        $stmt = $db->prepare("UPDATE tarefas SET concluida = 1 WHERE descricao = ?");
        $stmt->bindValue(1, $tarefa);
        $stmt->execute();
    }
}

echo "<script>alert('Tarefas atualizadas com sucesso.'); window.history.back();</script>";
?>