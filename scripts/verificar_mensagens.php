<?php
$db = new SQLite3('../dados.db');
$result = $db->query("SELECT * FROM mensagens ORDER BY data DESC");

echo "<h2>Mensagens da Gerência</h2><ul>";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<li><strong>" . $row['origem'] . "</strong>: " . htmlspecialchars($row['conteudo']) . " <em>(" . $row['data'] . ")</em></li>";
}
echo "</ul>";
?>