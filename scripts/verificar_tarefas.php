<?php
$db = new SQLite3('../dados.db');
$result = $db->query("SELECT descricao, concluida FROM tarefas");

echo "<h2>Estado das Tarefas</h2><ul>";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<li>" . $row['descricao'] . " - " . ($row['concluida'] ? "✅ Concluída" : "❌ Pendente") . "</li>";
}
echo "</ul>";
?>