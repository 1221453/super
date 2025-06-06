<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover'])) {
    $db = new SQLite3(__DIR__ . '/../db/super.db');

    foreach ($_POST['remover'] as $id) {
        $stmt = $db->prepare('DELETE FROM utilizadores WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }

    // Redireciona de volta para a página admin.html
    header('Location: ../admin.html');
    exit;
} else {
    echo "Nenhum utilizador selecionado.";
}
?>
